<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'category_id' => Category::factory(),
            'pengajar_id' => User::factory()->create(['role' => 'pengajar']),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 10000),
            'description' => fake()->paragraph(),
            'thumbnail' => null,
            'is_active' => true,
            'created_by' => User::factory()->create(['role' => 'admin']),
        ];
    }
}
