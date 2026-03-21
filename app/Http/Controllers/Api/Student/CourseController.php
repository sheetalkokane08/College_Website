<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
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

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->input('department_id'));
        }

        $courses = $query->paginate($request->input('per_page', 15));

        return CourseResource::collection($courses);
    }

    /**
     * Get enrolled courses for the authenticated student.
     */
    public function enrolled(Request $request)
    {
        $student = auth()->user();
        $courses = $student->courses()
            ->with(['department', 'faculty'])
            ->paginate($request->input('per_page', 15));

        return CourseResource::collection($courses);
    }
}
