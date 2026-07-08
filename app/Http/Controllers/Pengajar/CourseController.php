<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->taughtCourses()
            ->with('category')
            ->withCount(['materials', 'reviews'])
            ->latest()
            ->paginate(15);

        return view('pengajar.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('pengajar.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['pengajar_id'] = auth()->id();
        $validated['created_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create($validated);

        return redirect()->route('pengajar.courses.index')
            ->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $categories = Category::active()->get();
        return view('pengajar.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                \Storage::disk('public')->delete($course->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($validated);

        return redirect()->route('pengajar.courses.index')
            ->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($course->thumbnail) {
            \Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('pengajar.courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
