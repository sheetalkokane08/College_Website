<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Enroll student in a course.
     */
    public function store(Request $request, Course $course)
    {
        $student = auth()->user();

        // Check if already enrolled
        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this course');
        }

        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'semester' => $request->input('semester', null),
        ]);

        return back()->with('success', 'Successfully enrolled in ' . $course->name);
    }

    /**
     * Unenroll student from a course.
     */
    public function destroy(Course $course)
    {
        $student = auth()->user();

        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return back()->with('error', 'Enrollment not found');
        }

        $enrollment->delete();
        return back()->with('success', 'Successfully unenrolled from ' . $course->name);
    }
}
