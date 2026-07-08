<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Course;

class ReviewController extends Controller
{
    public function index()
    {
        $pengajar = auth()->user();

        $courses = $pengajar->taughtCourses()
            ->with(['reviews' => function($query) {
                $query->approved()->with('user')->latest();
            }])
            ->withCount('reviews')
            ->get();

        return view('pengajar.reviews.index', compact('courses'));
    }

    public function show(Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $reviews = $course->reviews()
            ->approved()
            ->with('user')
            ->latest()
            ->paginate(20);

        $stats = [
            'total_reviews' => $course->totalReviews(),
            'average_rating' => $course->averageRating(),
            'rating_distribution' => $course->reviews()
                ->approved()
                ->selectRaw('rating, COUNT(*) as count')
                ->groupBy('rating')
                ->orderBy('rating', 'desc')
                ->pluck('count', 'rating'),
        ];

        return view('pengajar.reviews.show', compact('course', 'reviews', 'stats'));
    }
}
