<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'student');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $students = $query->paginate($request->input('per_page', 15));

        return UserResource::collection($students);
    }

    /**
     * Display the specified student.
     */
    public function show(User $student)
    {
        if ($student->role !== 'student') {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return new UserResource($student);
    }
}
