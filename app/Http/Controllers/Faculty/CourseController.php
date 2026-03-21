<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Course;
use Illuminate\View\View;

class CourseController
{
    /**
     * Show all courses taught by this faculty member
     */
    public function index(): View
    {
        $faculty = auth()->user();
        $facultyRecord = $faculty->facultyRecord;

        $courses = Course::where('faculty_id', $facultyRecord?->id)
            ->with(['students', 'department', 'faculty'])
            ->paginate(15);

        return view('faculty.courses.index', [
            'courses' => $courses,
            'facultyRecord' => $facultyRecord,
        ]);
    }

    /**
     * Show course details with enrolled students
     */
    public function show(Course $course): View
    {
        $faculty = auth()->user();
        $facultyRecord = $faculty->facultyRecord;

        // ensure the faculty member can only view their own courses
        if ($course->faculty_id !== $facultyRecord?->id) {
            abort(403, 'Unauthorized');
        }

        $students = $course->students()->paginate(20);

        return view('faculty.courses.show', [
            'course' => $course,
            'students' => $students,
        ]);
    }
}
