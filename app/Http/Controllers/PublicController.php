<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::active()
            ->with(['category', 'pengajar'])
            ->withCount('materials')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::active()
            ->withCount('courses')
            ->get();

        $stats = [
            'total_courses' => Course::active()->count(),
            'total_categories' => Category::active()->count(),
            'total_materials' => Course::active()->withCount('materials')->get()->sum('materials_count'),
        ];

        return view('public.home', compact('featuredCourses', 'categories', 'stats'));
    }

    public function catalog(Request $request)
    {
        $query = Course::with(['category', 'pengajar'])
            ->active()
            ->withCount('materials');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $courses = $query->latest()->paginate(12);
        $categories = Category::active()->get();

        return view('public.catalog', compact('courses', 'categories'));
    }
}
