<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = User::where('role', 'student')->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the specified student.
     */
    public function show(User $student)
    {
        if ($student->role !== 'student') {
            abort(404);
        }

        $enrollments = $student->enrollments()->with('course')->paginate(10);
        return view('admin.students.show', compact('student', 'enrollments'));
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(User $student)
    {
        if ($student->role !== 'student') {
            abort(404);
        }

        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully');
    }
}
