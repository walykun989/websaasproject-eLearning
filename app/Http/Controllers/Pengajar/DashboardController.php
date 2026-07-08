<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajar = auth()->user();

        $stats = [
            'total_courses' => $pengajar->taughtCourses()->count(),
            'active_courses' => $pengajar->taughtCourses()->active()->count(),
            'total_materials' => $pengajar->taughtCourses()->withCount('materials')->get()->sum('materials_count'),
            'total_reviews' => $pengajar->taughtCourses()->withCount('reviews')->get()->sum('reviews_count'),
            'average_rating' => $pengajar->taughtCourses()->get()->avg(fn($course) => $course->averageRating()),
        ];

        $recentCourses = $pengajar->taughtCourses()
            ->withCount(['materials', 'reviews'])
            ->latest()
            ->take(5)
            ->get();

        return view('pengajar.dashboard', compact('stats', 'recentCourses'));
    }
}
