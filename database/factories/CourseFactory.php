<?php

namespace Database\Factories;

use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->words(5, true),
            'type' => rand(0, 1),
            'resources' => rand(1, 50),
            'year' => rand(1986, 2023),
            'price' => rand(0, 1) ? rand(1, 100) : 0.00,
            'image' => fake()->imageUrl(),
            'description' => fake()->paragraphs(3, true),
            'link' => fake()->url(),
            'submitted_by' => User::all()->random()->id,
            'duration' => rand(0, 2),
            'difficulty_level' => rand(0, 2),
            'platform_id' => Platform::all()->random()->id,
        ];
    }
}
