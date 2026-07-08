<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => fake()->sentence(4),
            'content_type' => fake()->randomElement(['video', 'text']),
            'content' => fake()->paragraph(),
            'order' => fake()->numberBetween(1, 10),
            'tier_required' => 'free',
            'duration_minutes' => fake()->numberBetween(5, 60),
            'is_published' => true,
        ];
    }
}
