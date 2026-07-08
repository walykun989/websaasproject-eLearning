<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Material;
use App\Models\Review;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_access_review_page_without_completing_course(): void
    {
        $user = User::factory()->create(['tier' => 'free']);
        $course = Course::factory()->create();
        Material::factory()->count(3)->create(['course_id' => $course->id, 'tier_required' => 'free']);

        $response = $this->actingAs($user)->get(route('peserta.review.create', $course->slug));

        $response->assertRedirect(route('peserta.learning.course', $course->slug));
        $response->assertSessionHas('error');
    }

    public function test_can_access_review_page_after_completing_course(): void
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

        $response = $this->actingAs($user)->get(route('peserta.review.create', $course->slug));

        $response->assertOk();
        $response->assertViewIs('peserta.reviews.create');
    }

    public function test_cannot_submit_review_without_completing_course(): void
    {
        $user = User::factory()->create(['tier' => 'free']);
        $course = Course::factory()->create();
        Material::factory()->count(3)->create(['course_id' => $course->id, 'tier_required' => 'free']);

        $response = $this->actingAs($user)->post(route('peserta.review.store', $course->slug), [
            'rating' => 5,
            'comment' => 'Great course! Very informative and well structured.',
        ]);

        $response->assertRedirect(route('peserta.learning.course', $course->slug));
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('reviews', 0);
    }

    public function test_can_submit_review_after_completing_course(): void
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

        $response = $this->actingAs($user)->post(route('peserta.review.store', $course->slug), [
            'rating' => 5,
            'comment' => 'Great course! Very informative and well structured.',
        ]);

        $response->assertRedirect(route('peserta.certificates.generate', $course->slug));
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => 5,
        ]);
    }

    public function test_cannot_submit_duplicate_review(): void
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

        Review::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => 5,
            'comment' => 'First review',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->post(route('peserta.review.store', $course->slug), [
            'rating' => 4,
            'comment' => 'Second review attempt',
        ]);

        $response->assertRedirect(route('peserta.catalog.show', $course->slug));
        $this->assertDatabaseCount('reviews', 1);
    }
}
