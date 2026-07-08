<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = auth()->user()->certificates()
            ->with('course')
            ->latest('issued_at')
            ->paginate(12);

        return view('peserta.certificates.index', compact('certificates'));
    }

    public function show($id)
    {
        $certificate = Certificate::where('id', $id)
            ->with(['user', 'course.pengajar', 'course.category'])
            ->firstOrFail();

        if ($certificate->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to certificate');
        }

        return view('peserta.certificates.show', compact('certificate'));
    }

    public function generate($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        $hasReview = $user->reviews()
            ->where('course_id', $course->id)
            ->exists();

        if (!$hasReview) {
            return redirect()->route('peserta.review.create', $slug)
                ->with('error', 'You must submit a review before generating your certificate');
        }

        $certificate = Certificate::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->with(['user', 'course.pengajar', 'course.category'])
            ->first();

        if (!$certificate) {
            $certificateModel = new Certificate();

            $certificate = Certificate::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'certificate_number' => $certificateModel->generateCertificateNumber(),
                'issued_at' => now(),
            ]);

            $certificate->load(['user', 'course.pengajar', 'course.category']);
            $certificate->file_path = $certificate->generatePDF();
            $certificate->save();
        }

        return view('peserta.certificates.show', compact('certificate'));
    }

    public function download($certificateNumber)
    {
        $certificate = Certificate::where('certificate_number', $certificateNumber)
            ->with(['user', 'course.pengajar', 'course.category'])
            ->firstOrFail();

        if ($certificate->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to certificate');
        }

        if (!$certificate->file_path || !\Storage::exists($certificate->file_path)) {
            $certificate->file_path = $certificate->generatePDF();
            $certificate->save();
        }

        $filename = 'SERTIFIKAT ' . $certificate->course->title . ' - ' . $certificate->user->name . '.pdf';
        return \Storage::download($certificate->file_path, $filename);
    }
}
