<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $enrolledCourses = $user->progress()
            ->with(['material.course.category'])
            ->get()
            ->pluck('material.course')
            ->filter()  // Remove null courses
            ->unique('id')
            ->map(function($course) use ($user) {
                $totalMaterials = $course->materials()->count();
                $accessedMaterials = $user->progress()
                    ->whereHas('material', fn($q) => $q->where('course_id', $course->id))
                    ->count();

                $course->progress_percentage = $totalMaterials > 0
                    ? round(($accessedMaterials / $totalMaterials) * 100)
                    : 0;

                return $course;
            });

        return view('peserta.learning.index', compact('enrolledCourses'));
    }

    public function course($slug)
    {
        $course = Course::where('slug', $slug)
            ->with(['category', 'pengajar', 'materials' => function($query) {
                $query->published()->ordered();
            }])
            ->firstOrFail();

        $user = auth()->user();

        $materials = $course->materials->map(function($material) use ($user) {
            $material->is_accessible = $material->isAccessibleBy($user);
            $material->user_progress = $user->progress()
                ->where('material_id', $material->id)
                ->first();
            return $material;
        });

        return view('peserta.learning.course', compact('course', 'materials'));
    }

    public function material($slug, $materialId)
    {
        $material = Material::with('course')->findOrFail($materialId);
        $user = auth()->user();
        $course = $material->course;

        $allMaterials = $course->materials()->published()->ordered()->get();
        $currentIndex = $allMaterials->search(fn($m) => $m->id === $material->id);
        $isLastMaterial = $currentIndex === $allMaterials->count() - 1;

        if ($isLastMaterial && $user->tier === 'free') {
            return redirect()->route('peserta.pricing')
                ->with('paywall', true)
                ->with('error', 'Upgrade ke tier Apik untuk mengakses materi terakhir dan menyelesaikan kursus ini');
        }

        $tierHierarchy = ['free' => 0, 'apik' => 1, 'sangar' => 2];

        if ($tierHierarchy[$user->tier] < $tierHierarchy[$material->tier_required]) {
            return redirect()->route('peserta.pricing')
                ->with('paywall', true)
                ->with('material_id', $materialId)
                ->with('error', 'Upgrade to ' . ucfirst($material->tier_required) . ' tier to access this material');
        }

        UserProgress::updateOrCreate([
            'user_id' => $user->id,
            'material_id' => $materialId,
        ], [
            'last_accessed_at' => now(),
        ]);

        $prevMaterial = $currentIndex > 0 ? $allMaterials[$currentIndex - 1] : null;
        $nextMaterial = $currentIndex < $allMaterials->count() - 1 ? $allMaterials[$currentIndex + 1] : null;

        $userProgress = UserProgress::where('user_id', $user->id)
            ->where('material_id', $materialId)
            ->first();

        return view('peserta.learning.material', compact('material', 'course', 'prevMaterial', 'nextMaterial', 'userProgress'));
    }

    public function markComplete(Request $request, $slug, $materialId)
    {
        $progress = UserProgress::where('user_id', auth()->id())
            ->where('material_id', $materialId)
            ->firstOrFail();

        $progress->markAsCompleted();

        return back()->with('success', 'Material marked as completed');
    }
}
