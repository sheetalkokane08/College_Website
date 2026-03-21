<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        // Check if email exists in faculty table
        $faculty = \App\Models\Faculty::where('email', $validated['email'])->first();
        // Check if email exists in user table with role student
        $student = User::where('email', $validated['email'])->where('role', 'student')->first();

        if ($faculty) {
            $role = 'faculty';
        } elseif ($student) {
            return response()->json([
                'message' => 'Student already registered',
            ], 409);
        } else {
            // Check if email exists in student table (if you have a separate student table, add check here)
            // For now, allow registration only if email exists in faculty table or not registered as student
            $role = 'student';
        }

        // Only allow registration if email exists in faculty table or is not already registered as student
        if ($role === 'faculty' || $role === 'student') {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['phone'] ?? null,
                'role' => $role,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User registered successfully',
                'data' => new UserResource($user),
                'token' => $token,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Registration not allowed. Email not found in faculty records.',
            ], 403);
        }
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'data' => new UserResource($user),
            'token' => $token,
        ]);
    }

    /**
     * Get authenticated user
     */
    public function me()
    {
        return response()->json([
            'data' => new UserResource(auth()->user()),
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
