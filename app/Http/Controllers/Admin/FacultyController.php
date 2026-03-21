<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;
use App\Models\Department;
use App\Models\Faculty;

class FacultyController extends Controller
{
    /**
     * Display a listing of faculty.
     */
    public function index()
    {
        $faculty = Faculty::with('department')->paginate(15);
        return view('admin.faculty.index', compact('faculty'));
    }

    /**
     * Show the form for creating a new faculty.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.faculty.create', compact('departments'));
    }

    /**
     * Store a newly created faculty in storage.
     */
    public function store(StoreFacultyRequest $request)
    {
        Faculty::create($request->validated());
        return redirect()->route('admin.faculty.index')->with('success', 'Faculty created successfully');
    }

    /**
     * Show the form for editing the specified faculty.
     */
    public function edit(Faculty $faculty)
    {
        $departments = Department::all();
        return view('admin.faculty.edit', compact('faculty', 'departments'));
    }

    /**
     * Update the specified faculty in storage.
     */
    public function update(UpdateFacultyRequest $request, Faculty $faculty)
    {
        $faculty->update($request->validated());
        return redirect()->route('admin.faculty.index')->with('success', 'Faculty updated successfully');
    }

    /**
     * Remove the specified faculty from storage.
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('admin.faculty.index')->with('success', 'Faculty deleted successfully');
    }
}
