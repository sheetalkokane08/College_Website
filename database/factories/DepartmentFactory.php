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

        $englishDescriptions = [
            'Computer Science' => 'Computer Science department focuses on programming, algorithms, and systems design.',
            'Information Technology' => 'Information Technology department prepares students in network and systems management.',
            'Mechanical Engineering' => 'Mechanical Engineering department emphasizes machine design, thermodynamics, and materials.',
            'Civil Engineering' => 'Civil Engineering department focuses on infrastructure, structural systems, and urban planning.',
            'Electrical Engineering' => 'Electrical Engineering department covers circuits, electronics, and power systems.',
            'Mathematics' => 'Mathematics department provides core training in calculus, algebra, and statistics.',
            'Physics' => 'Physics department provides instruction in mechanics, optics, and modern physics.',
            'Chemistry' => 'Chemistry department covers organic, inorganic, and physical chemistry principles.',
            'Business Administration' => 'Business Administration department teaches management, finance, and marketing.',
            'Biology' => 'Biology department focuses on cellular, molecular, and ecological sciences.',
        ];

        return [
            'name' => $name,
            'code' => strtoupper(preg_replace('/\W+/', '', substr($name, 0, 3))) . $this->faker->unique()->numberBetween(100, 999),
            'description' => $englishDescriptions[$name] ?? 'Department of ' . $name . ' offering high-quality programs.',
        ];
    }
}
