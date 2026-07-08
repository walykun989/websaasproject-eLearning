<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Material;
use App\Models\Review;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificateGenerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_generate_certificate_without_review(): void
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

        $response = $this->actingAs($user)->get(route('peserta.certificates.generate', $course->slug));

        $response->assertRedirect(route('peserta.review.create', $course->slug));
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('certificates', 0);
    }

    public function test_can_generate_certificate_after_review(): void
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
            'comment' => 'Great course!',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->get(route('peserta.certificates.generate', $course->slug));

        $response->assertOk();
        $response->assertViewIs('peserta.certificates.show');
        $this->assertDatabaseHas('certificates', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }

    public function test_certificate_is_only_generated_once_per_user_per_course(): void
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
            'comment' => 'Great course!',
            'is_approved' => true,
        ]);

        $this->actingAs($user)->get(route('peserta.certificates.generate', $course->slug));
        $this->actingAs($user)->get(route('peserta.certificates.generate', $course->slug));

        $this->assertDatabaseCount('certificates', 1);
    }

    public function test_certificate_number_is_unique(): void
    {
        $user1 = User::factory()->create(['tier' => 'free']);
        $user2 = User::factory()->create(['tier' => 'free']);
        $course = Course::factory()->create();
        $materials = Material::factory()->count(3)->create(['course_id' => $course->id, 'tier_required' => 'free']);

        foreach ([$user1, $user2] as $user) {
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
                'comment' => 'Great course!',
                'is_approved' => true,
            ]);
        }

        $this->actingAs($user1)->get(route('peserta.certificates.generate', $course->slug));
        $this->actingAs($user2)->get(route('peserta.certificates.generate', $course->slug));

        $cert1 = Certificate::where('user_id', $user1->id)->first();
        $cert2 = Certificate::where('user_id', $user2->id)->first();

        $this->assertNotEquals($cert1->certificate_number, $cert2->certificate_number);
    }

    public function test_full_workflow_from_completion_to_certificate(): void
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

        $this->assertTrue($user->fresh()->hasCompletedCourse($course));

        $reviewResponse = $this->actingAs($user)->post(route('peserta.review.store', $course->slug), [
            'rating' => 5,
            'comment' => 'Excellent course, learned a lot!',
        ]);

        $reviewResponse->assertRedirect(route('peserta.certificates.generate', $course->slug));

        $certificateResponse = $this->actingAs($user)->get(route('peserta.certificates.generate', $course->slug));

        $certificateResponse->assertOk();
        $this->assertDatabaseHas('certificates', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }
}
