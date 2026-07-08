<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MandatoryReviewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_user_without_review_cannot_generate_certificate(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();

        $response = $this->actingAs($user)
            ->get(route('peserta.certificates.generate', $course->slug));

        $response->assertRedirect(route('peserta.review.create', $course->slug));
        $response->assertSessionHas('error', 'You must submit a review before generating your certificate');
    }

    public function test_user_with_review_can_generate_certificate(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();

        Review::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => 5,
            'comment' => 'Great course!',
        ]);

        $response = $this->actingAs($user)
            ->get(route('peserta.certificates.generate', $course->slug));

        $response->assertStatus(200);
        $response->assertViewIs('peserta.certificates.show');
    }

    public function test_certificate_is_generated_only_once(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();

        Review::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => 5,
            'comment' => 'Great course!',
        ]);

        $this->actingAs($user)
            ->get(route('peserta.certificates.generate', $course->slug));

        $firstCertificate = $user->certificates()->where('course_id', $course->id)->first();

        $this->actingAs($user)
            ->get(route('peserta.certificates.generate', $course->slug));

        $certificateCount = $user->certificates()->where('course_id', $course->id)->count();

        $this->assertEquals(1, $certificateCount);
        $this->assertNotNull($firstCertificate);
    }

    public function test_different_users_get_different_certificates(): void
    {
        $user1 = User::where('email', 'budi@example.com')->first();
        $user2 = User::where('email', 'joko@example.com')->first();
        $course = Course::where('slug', 'laravel-web-development-mastery')->first();

        Review::create([
            'user_id' => $user1->id,
            'course_id' => $course->id,
            'rating' => 5,
            'comment' => 'Great course!',
        ]);

        Review::create([
            'user_id' => $user2->id,
            'course_id' => $course->id,
            'rating' => 4,
            'comment' => 'Good course!',
        ]);

        $this->actingAs($user1)
            ->get(route('peserta.certificates.generate', $course->slug));

        $this->actingAs($user2)
            ->get(route('peserta.certificates.generate', $course->slug));

        $cert1 = $user1->certificates()->where('course_id', $course->id)->first();
        $cert2 = $user2->certificates()->where('course_id', $course->id)->first();

        $this->assertNotNull($cert1);
        $this->assertNotNull($cert2);
        $this->assertNotEquals($cert1->certificate_number, $cert2->certificate_number);
    }

    public function test_user_can_review_multiple_courses_independently(): void
    {
        $user = User::where('email', 'budi@example.com')->first();
        $course1 = Course::where('slug', 'laravel-web-development-mastery')->first();
        $course2 = Course::where('slug', 'react-typescript-complete-guide')->first();

        Review::create([
            'user_id' => $user->id,
            'course_id' => $course1->id,
            'rating' => 5,
            'comment' => 'Great course!',
        ]);

        $response1 = $this->actingAs($user)
            ->get(route('peserta.certificates.generate', $course1->slug));

        $response2 = $this->actingAs($user)
            ->get(route('peserta.certificates.generate', $course2->slug));

        $response1->assertStatus(200);
        $response2->assertRedirect(route('peserta.review.create', $course2->slug));
    }
}
