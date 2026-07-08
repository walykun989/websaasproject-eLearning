<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Material;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseCompletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_not_completed_course_with_no_progress(): void
    {
        $user = User::factory()->create(['tier' => 'free']);
        $course = Course::factory()->create();
        Material::factory()->count(3)->create(['course_id' => $course->id, 'tier_required' => 'free']);

        $this->assertFalse($user->hasCompletedCourse($course));
    }

    public function test_user_has_not_completed_course_with_partial_progress(): void
    {
        $user = User::factory()->create(['tier' => 'free']);
        $course = Course::factory()->create();
        $materials = Material::factory()->count(3)->create(['course_id' => $course->id, 'tier_required' => 'free']);

        UserProgress::create([
            'user_id' => $user->id,
            'material_id' => $materials[0]->id,
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        $this->assertFalse($user->hasCompletedCourse($course));
    }

    public function test_free_user_completes_course_with_all_free_materials(): void
    {
        $user = User::factory()->create(['tier' => 'free']);
        $course = Course::factory()->create();
        $materials = Material::factory()->count(3)->create(['course_id' => $course->id, 'tier_required' => 'free']);

        foreach ($materials as $material) {
            UserProgress::create([
                'user_id' => $user->id,
                'material_id' => $material->id,
                'is_completed' => true,
                'completed_at' => now(),
            ]);
        }

        $this->assertTrue($user->hasCompletedCourse($course));
    }

    public function test_free_user_cannot_complete_course_with_premium_materials(): void
    {
        $user = User::factory()->create(['tier' => 'free']);
        $course = Course::factory()->create();

        $freeMaterials = Material::factory()->count(2)->create(['course_id' => $course->id, 'tier_required' => 'free']);
        $premiumMaterial = Material::factory()->create(['course_id' => $course->id, 'tier_required' => 'apik']);

        foreach ($freeMaterials as $material) {
            UserProgress::create([
                'user_id' => $user->id,
                'material_id' => $material->id,
                'is_completed' => true,
                'completed_at' => now(),
            ]);
        }

        $this->assertTrue($user->hasCompletedCourse($course));
    }

    public function test_premium_user_completes_course_with_all_accessible_materials(): void
    {
        $user = User::factory()->create(['tier' => 'apik']);
        $course = Course::factory()->create();

        $materials = Material::factory()->count(3)->create(['course_id' => $course->id, 'tier_required' => 'apik']);

        foreach ($materials as $material) {
            UserProgress::create([
                'user_id' => $user->id,
                'material_id' => $material->id,
                'is_completed' => true,
                'completed_at' => now(),
            ]);
        }

        $this->assertTrue($user->hasCompletedCourse($course));
    }

    public function test_course_completion_ignores_inaccessible_materials(): void
    {
        $user = User::factory()->create(['tier' => 'apik']);
        $course = Course::factory()->create();

        $apikMaterials = Material::factory()->count(2)->create(['course_id' => $course->id, 'tier_required' => 'apik']);
        $sangarMaterial = Material::factory()->create(['course_id' => $course->id, 'tier_required' => 'sangar']);

        foreach ($apikMaterials as $material) {
            UserProgress::create([
                'user_id' => $user->id,
                'material_id' => $material->id,
                'is_completed' => true,
                'completed_at' => now(),
            ]);
        }

        $this->assertTrue($user->hasCompletedCourse($course));
    }
}
