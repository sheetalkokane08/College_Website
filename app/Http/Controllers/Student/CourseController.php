<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of available courses.
     */
    public function index(Request $request)
    {
        $query = Course::with(['department', 'faculty']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
        }

        if ($request->filled('department')) {
            $query->where('department_id', $request->input('department'));
        }

        $courses = $query->paginate(15);
        $departments = \App\Models\Department::all();

        return view('student.courses.index', compact('courses', 'departments'));
    }

    /**
     * Show the specified course.
     */
    public function show(Course $course)
    {
        $course->load(['department', 'faculty', 'students']);
        return view('student.courses.show', compact('course'));
    }

    /**
     * Display enrolled courses.
     */
    public function enrolled()
    {
        $student = auth()->user();
        $courses = $student->courses()->paginate(10);
        return view('student.courses.enrolled', compact('courses'));
    }
}
