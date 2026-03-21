<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $student = auth()->user();
        $enrolled_courses = $student->courses()->paginate(10);
        $enrollments_count = $student->enrollments()->count();

        return view('student.dashboard', compact('student', 'enrolled_courses', 'enrollments_count'));
    }
}
