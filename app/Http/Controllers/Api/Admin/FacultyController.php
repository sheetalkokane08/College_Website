<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of faculty.
     */
    public function index(Request $request)
    {
        $query = Faculty::with('department');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->input('department_id'));
        }

        $faculty = $query->paginate($request->input('per_page', 15));

        return FacultyResource::collection($faculty);
    }

    /**
     * Display the specified faculty.
     */
    public function show(Faculty $faculty)
    {
        return new FacultyResource($faculty->load('department'));
    }
}
