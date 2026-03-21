<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Create departments
        $departments = Department::factory(10)->create();

        // Create faculty for each department
        $faculty_list = [];
        foreach ($departments as $department) {
            $faculty_list = array_merge(
                $faculty_list,
                Faculty::factory(2)->create(['department_id' => $department->id])->toArray()
            );
        }

        // create faculty user accounts from the first 5 faculty records
        $faculty_records = Faculty::limit(5)->get();
        foreach ($faculty_records as $fac) {
            User::factory()->create([
                'name' => $fac->name,
                'email' => $fac->email,
                'role' => 'faculty',
                'password' => bcrypt('password'),
            ]);
        }

        // sample notices for first two faculty members
        $sampleFacs = Faculty::take(2)->get();
        foreach ($sampleFacs as $index => $fac) {
            \App\Models\Notice::create([
                'title' => "Important update from {$fac->name}",
                'body' => "This is a sample notice posted by {$fac->name}. It will require admin approval.",
                'faculty_id' => $fac->id,
                'approved' => $index === 0, // first notice approved
            ]);
        }

        // Create courses with titles tailored to each department
        $courses = [];

        // mapping of department keywords to relevant course titles
        $courseMap = [
            'Computer' => [
                'Introduction to Programming',
                'Data Structures',
                'Algorithms',
                'Operating Systems',
                'Computer Networks',
                'Software Engineering',
                'Database Systems',
                'Artificial Intelligence',
                'Machine Learning',
            ],
            'Engineering' => [
                'Statics',
                'Dynamics',
                'Thermodynamics',
                'Fluid Mechanics',
                'Materials Science',
                'Control Systems',
            ],
            'Mathematics' => [
                'Calculus I',
                'Linear Algebra',
                'Discrete Mathematics',
                'Probability and Statistics',
                'Differential Equations',
            ],
            'Physics' => [
                'Classical Mechanics',
                'Electromagnetism',
                'Quantum Physics',
                'Thermodynamics',
                'Optics',
            ],
            'Chemistry' => [
                'Organic Chemistry',
                'Inorganic Chemistry',
                'Physical Chemistry',
                'Analytical Chemistry',
            ],
            'Business' => [
                'Microeconomics',
                'Macroeconomics',
                'Marketing Principles',
                'Financial Accounting',
            ],
            'Biology' => [
                'Cell Biology',
                'Genetics',
                'Ecology',
                'Molecular Biology',
            ],
        ];

        $courseCounter = 1; // global counter to guarantee unique codes

        foreach ($departments as $department) {
            // find course list by keyword
            $titles = ['General Studies'];
            foreach ($courseMap as $keyword => $list) {
                if (stripos($department->name, $keyword) !== false) {
                    $titles = $list;
                    break;
                }
            }

            for ($i = 0; $i < 5; $i++) {
                $randomFaculty = Faculty::where('department_id', $department->id)->inRandomOrder()->first();

                // select a title from the department-specific list; wrap around if needed
                $name = $titles[$i % count($titles)];

                $code = strtoupper(substr(preg_replace('/\W+/', '', $name), 0, 3))
                    . '-' . str_pad($courseCounter++, 3, '0', STR_PAD_LEFT);

                $course = Course::create([
                    'name' => $name,
                    'code' => $code,
                    'description' => 'This course belongs to the ' . $department->name . ' department.',
                    'credits' => rand(1, 4),
                    'department_id' => $department->id,
                    'faculty_id' => $randomFaculty->id,
                ]);
                $courses[] = $course;
            }
        }

        // Create students
        $students = User::factory(100)->create([
            'role' => 'student',
            'password' => bcrypt('password'),
        ]);

        // Create random enrollments
        foreach ($students as $student) {
            $numCourses = rand(2, 6);
            $randomCourses = collect($courses)->random($numCourses);
            
            foreach ($randomCourses as $course) {
                try {
                    Enrollment::create([
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'semester' => 'Fall 2024',
                    ]);
                } catch (\Exception $e) {
                    // Skip duplicate enrollments
                }
            }
        }

        $this->command->info('Database seeding completed successfully!');
    }
}
