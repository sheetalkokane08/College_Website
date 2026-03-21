<?php

namespace App\Http\Controllers\Api\Faculty;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController
{
    /**
     * Get all courses taught by the authenticated faculty member
     */
    public function index(Request $request): JsonResponse
    {
        $faculty = auth()->user();
        $facultyRecord = $faculty->facultyRecord;

        if (!$facultyRecord) {
            return response()->json(['message' => 'Faculty record not found'], 404);
        }

        $query = Course::where('faculty_id', $facultyRecord->id)->with(['students', 'department']);

        $per_page = $request->query('per_page', 15);
        $courses = $query->paginate($per_page);

        return response()->json([
            'data' => CourseResource::collection($courses->items()),
            'links' => [
                'first' => $courses->url(1),
                'last' => $courses->url($courses->lastPage()),
                'prev' => $courses->previousPageUrl(),
                'next' => $courses->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $courses->currentPage(),
                'from' => $courses->firstItem(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'to' => $courses->lastItem(),
                'total' => $courses->total(),
            ],
        ]);
    }

    /**
     * Get one course with enrolled students
     */
    public function show(Course $course): JsonResponse
    {
        $faculty = auth()->user();
        $facultyRecord = $faculty->facultyRecord;

        if ($course->faculty_id !== $facultyRecord?->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $course->load(['students', 'department', 'faculty']);

        return response()->json([
            'data' => new CourseResource($course),
        ]);
    }
}
