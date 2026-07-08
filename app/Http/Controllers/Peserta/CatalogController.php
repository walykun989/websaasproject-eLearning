<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
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

        return view('peserta.catalog.index', compact('courses', 'categories'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->with(['category', 'pengajar', 'materials' => function($query) {
                $query->published()->ordered();
            }])
            ->withCount('reviews')
            ->firstOrFail();

        $freeMaterialsCount = $course->materials->where('tier_required', 'free')->count();
        $averageRating = $course->averageRating();

        $userHasReviewed = auth()->check() && $course->hasMandatoryReviewFrom(auth()->user());

        return view('peserta.catalog.show', compact('course', 'freeMaterialsCount', 'averageRating', 'userHasReviewed'));
    }

    public function category($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->active()->firstOrFail();

        $courses = Course::where('category_id', $category->id)
            ->with(['category', 'pengajar'])
            ->active()
            ->withCount('materials')
            ->latest()
            ->paginate(12);

        return view('peserta.catalog.category', compact('category', 'courses'));
    }
}
