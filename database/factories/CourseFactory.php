<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // realistic course titles to make seeded data meaningful
        static $titles = [
            'Introduction to Computer Science',
            'Data Structures',
            'Algorithms',
            'Operating Systems',
            'Database Systems',
            'Computer Networks',
            'Software Engineering',
            'Artificial Intelligence',
            'Machine Learning',
            'Human Computer Interaction',
            'Discrete Mathematics',
            'Web Development',
            'Mobile App Development',
            'Cyber Security',
            'Cloud Computing',
        ];

        $name = $this->faker->unique()->randomElement($titles);

        return [
            'name' => $name,
            'code' => strtoupper(substr(preg_replace('/\W+/', '', $name), 0, 3)) . '-' . $this->faker->unique()->numberBetween(100, 499),
            'description' => $this->faker->sentence(),
            'credits' => $this->faker->numberBetween(1, 4),
            'department_id' => null,
            'faculty_id' => null,
        ];
    }
}
