<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCertificateEligibility
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $courseSlug = $request->route('slug');

        if (!$courseSlug) {
            return $next($request);
        }

        $course = Course::where('slug', $courseSlug)->first();

        if (!$course) {
            abort(404);
        }

        $user = auth()->user();

        $hasReview = $user->reviews()
            ->where('course_id', $course->id)
            ->exists();

        if (!$hasReview) {
            return redirect()->route('peserta.review.create', $courseSlug)
                ->with('error', 'You must submit a review before generating your certificate');
        }

        return $next($request);
    }
}
