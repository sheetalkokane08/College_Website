<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\EnrollmentResource;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{
    /**
     * Enroll student in a course.
     */
    public function enroll(Request $request, Course $course)
    {
        $student = auth()->user();

        // Check if already enrolled
        if ($student->courses()->where('course_id', $course->id)->exists()) {
            throw ValidationException::withMessages([
                'enrollment' => ['You are already enrolled in this course'],
            ]);
        }

        $enrollment = Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'semester' => $request->input('semester', null),
        ]);

        return response()->json([
            'message' => 'Successfully enrolled in course',
            'data' => new EnrollmentResource($enrollment->load(['student', 'course'])),
        ], 201);
    }

    /**
     * Unenroll student from a course.
     */
    public function unenroll(Course $course)
    {
        $student = auth()->user();

        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $enrollment->delete();

        return response()->json([
            'message' => 'Successfully unenrolled from course',
        ]);
    }
}
