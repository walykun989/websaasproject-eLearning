<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $materials = $course->materials()->ordered()->get();
        return view('pengajar.materials.index', compact('course', 'materials'));
    }

    public function create(Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('pengajar.materials.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:video,text',
            'content' => 'required|string',
            'tier_required' => 'required|in:free,apik,sangar',
            'duration_minutes' => 'nullable|integer|min:1',
            'is_published' => 'boolean',
        ]);

        $validated['course_id'] = $course->id;
        $validated['order'] = $course->materials()->max('order') + 1;
        $validated['is_published'] = $request->has('is_published');

        Material::create($validated);

        return redirect()->route('pengajar.courses.materials.index', $course)
            ->with('success', 'Material created successfully');
    }

    public function edit(Course $course, Material $material)
    {
        if ($course->pengajar_id !== auth()->id() || $material->course_id !== $course->id) {
            abort(403, 'Unauthorized');
        }

        return view('pengajar.materials.edit', compact('course', 'material'));
    }

    public function update(Request $request, Course $course, Material $material)
    {
        if ($course->pengajar_id !== auth()->id() || $material->course_id !== $course->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:video,text',
            'content' => 'required|string',
            'tier_required' => 'required|in:free,apik,sangar',
            'duration_minutes' => 'nullable|integer|min:1',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $material->update($validated);

        return redirect()->route('pengajar.courses.materials.index', $course)
            ->with('success', 'Material updated successfully');
    }

    public function destroy(Course $course, Material $material)
    {
        if ($course->pengajar_id !== auth()->id() || $material->course_id !== $course->id) {
            abort(403, 'Unauthorized');
        }

        $material->delete();

        return redirect()->route('pengajar.courses.materials.index', $course)
            ->with('success', 'Material deleted successfully');
    }

    public function reorder(Request $request, Course $course)
    {
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'materials' => 'required|array',
            'materials.*' => 'required|exists:materials,id',
        ]);

        foreach ($validated['materials'] as $index => $materialId) {
            Material::where('id', $materialId)
                ->where('course_id', $course->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
