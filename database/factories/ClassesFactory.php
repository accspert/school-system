<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Course;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'year' => $this->faker->year(),
            'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
        ];
    }
}
