<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Course;
use Illuminate\View\View;

class DashboardController
{
    /**
     * Show the faculty dashboard
     */
    public function index(): View
    {
        $faculty = auth()->user();
        $facultyRecord = $faculty->facultyRecord;

        // get courses taught by this faculty member
        $courses = Course::where('faculty_id', $facultyRecord?->id)
            ->with(['students', 'department'])
            ->paginate(10);

        $stats = [
            'total_courses' => $facultyRecord ? Course::where('faculty_id', $facultyRecord->id)->count() : 0,
            'total_students' => $facultyRecord ? Course::where('faculty_id', $facultyRecord->id)
                ->withCount('students')
                ->get()
                ->sum('students_count') : 0,
        ];

        return view('faculty.dashboard', [
            'faculty' => $faculty,
            'facultyRecord' => $facultyRecord,
            'courses' => $courses,
            'stats' => $stats,
        ]);
    }
}
