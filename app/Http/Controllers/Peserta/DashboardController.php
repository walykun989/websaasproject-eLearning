<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $enrolledCourses = $user->progress()
            ->with(['material.course.category'])
            ->get()
            ->pluck('material.course')
            ->unique('id')
            ->take(10);

        $recentProgress = $user->progress()
            ->with('material.course')
            ->latest('last_accessed_at')
            ->take(5)
            ->get();

        $certificates = $user->certificates()
            ->with('course')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'courses_enrolled' => $enrolledCourses->count(),
            'materials_completed' => $user->progress()->where('is_completed', true)->count(),
            'certificates_earned' => $user->certificates()->count(),
            'reviews_submitted' => $user->reviews()->count(),
        ];

        return view('peserta.dashboard', compact('enrolledCourses', 'recentProgress', 'certificates', 'stats'));
    }
}
