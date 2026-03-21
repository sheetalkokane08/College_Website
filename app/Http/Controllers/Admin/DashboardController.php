<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\Faculty;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_courses' => Course::count(),
            'total_faculty' => Faculty::count(),
            'total_departments' => Department::count(),
            'total_enrollments' => Enrollment::count(),
        ];

        $recent_enrollments = Enrollment::with(['student', 'course'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_enrollments'));
    }
}
