<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        $existingReview = Review::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingReview) {
            return redirect()->route('peserta.catalog.show', $slug)
                ->with('info', 'You have already reviewed this course');
        }

        if (!$user->hasCompletedCourse($course)) {
            return redirect()->route('peserta.learning.course', $slug)
                ->with('error', 'Anda harus menyelesaikan semua materi yang dapat diakses sebelum memberikan review');
        }

        return view('peserta.reviews.create', compact('course'));
    }

    public function store(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        $existingReview = Review::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingReview) {
            return redirect()->route('peserta.catalog.show', $slug)
                ->with('info', 'You have already reviewed this course');
        }

        if (!$user->hasCompletedCourse($course)) {
            return redirect()->route('peserta.learning.course', $slug)
                ->with('error', 'Anda harus menyelesaikan semua materi yang dapat diakses sebelum memberikan review');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        Review::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => true,
        ]);

        return redirect()->route('peserta.certificates.generate', $slug)
            ->with('success', 'Review submitted. Your certificate is now being generated.');
    }
}
