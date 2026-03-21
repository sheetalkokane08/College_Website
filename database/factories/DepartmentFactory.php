<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // predefined department names for readability
        static $names = [
            'Computer Science',
            'Information Technology',
            'Mechanical Engineering',
            'Civil Engineering',
            'Electrical Engineering',
            'Mathematics',
            'Physics',
            'Chemistry',
            'Business Administration',
            'Biology',
        ];

        $name = $this->faker->unique()->randomElement($names);

        return [
            'name' => $name,
            'code' => strtoupper(preg_replace('/\W+/', '', substr($name, 0, 3))) . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->sentence(),
        ];
    }
}
