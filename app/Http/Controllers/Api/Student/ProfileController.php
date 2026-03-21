<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    /**
     * Get authenticated student's profile.
     */
    public function show()
    {
        return response()->json([
            'data' => new UserResource(auth()->user()),
        ]);
    }
}
