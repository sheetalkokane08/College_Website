<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => null,
            'course_id' => null,
            'semester' => $this->faker->randomElement(['Fall 2024', 'Spring 2025', 'Summer 2024']),
        ];
    }
}
