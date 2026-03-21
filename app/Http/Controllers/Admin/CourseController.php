<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index()
    {
        $courses = Course::with(['department', 'faculty'])->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        $departments = Department::all();
        $faculty = Faculty::all();
        return view('admin.courses.create', compact('departments', 'faculty'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $departments = Department::all();
        $faculty = Faculty::all();
        return view('admin.courses.edit', compact('course', 'departments', 'faculty'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }
}
