<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FreemiumLockTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_free_user_can_access_first_material(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();
        $firstMaterial = $course->materials()->ordered()->first();

        $response = $this->actingAs($user)
            ->get(route('peserta.learning.material', [
                'slug' => $course->slug,
                'material' => $firstMaterial->id,
            ]));

        $response->assertStatus(200);
    }

    public function test_free_user_can_access_middle_material(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();
        $materials = $course->materials()->ordered()->get();
        $middleMaterial = $materials[1];

        $response = $this->actingAs($user)
            ->get(route('peserta.learning.material', [
                'slug' => $course->slug,
                'material' => $middleMaterial->id,
            ]));

        $response->assertStatus(200);
    }

    public function test_free_user_cannot_access_last_material(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();
        $lastMaterial = $course->materials()->ordered()->get()->last();

        $response = $this->actingAs($user)
            ->get(route('peserta.learning.material', [
                'slug' => $course->slug,
                'material' => $lastMaterial->id,
            ]));

        $response->assertRedirect(route('peserta.pricing'));
        $response->assertSessionHas('paywall', true);
    }

    public function test_apik_user_blocked_by_tier_check_for_sangar_material(): void
    {
        $user = User::where('email', 'rina@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();
        $lastMaterial = $course->materials()->ordered()->get()->last();

        $response = $this->actingAs($user)
            ->get(route('peserta.learning.material', [
                'slug' => $course->slug,
                'material' => $lastMaterial->id,
            ]));

        $response->assertRedirect(route('peserta.pricing'));
    }

    public function test_sangar_user_can_access_last_material(): void
    {
        $user = User::where('email', 'joko@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();
        $lastMaterial = $course->materials()->ordered()->get()->last();

        $response = $this->actingAs($user)
            ->get(route('peserta.learning.material', [
                'slug' => $course->slug,
                'material' => $lastMaterial->id,
            ]));

        $response->assertStatus(200);
    }

    public function test_free_user_blocked_with_correct_message(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();
        $lastMaterial = $course->materials()->ordered()->get()->last();

        $response = $this->actingAs($user)
            ->get(route('peserta.learning.material', [
                'slug' => $course->slug,
                'material' => $lastMaterial->id,
            ]));

        $response->assertSessionHas('error', 'Upgrade ke tier Apik untuk mengakses materi terakhir dan menyelesaikan kursus ini');
    }
}
