<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $limit = request()->input('limit', 10);
            $users = User::limit($limit)->get();
            return response()->json([
                "status" => "Get Data User",
                "data" => $users
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to retrieve data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:admin,user',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            $user = User::create($validatedData);

            return response()->json([
                "status" => "Success",
                "message" => "User created successfully!",
                "data" => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "Error",
                "message" => "Failed to create user.",
                "error" => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        try {
            return response()->json([
                "status" => "Success",
                "message" => "Get User Data",
                "data" => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "Error",
                "message" => "Failed to retrieve user data.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'sometimes|max:50',
                'email' => 'sometimes|email|unique:users,email,' . $user->id,
                'password' => 'sometimes|min:6',
                'role' => 'sometimes|in:admin,user',
            ]);

            if (isset($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $user->update($validatedData);

            return response()->json([
                "status" => "Success",
                "message" => "User updated successfully!",
                "data" => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "Error",
                "message" => "Failed to update user.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();

            return response()->json([
                "status" => "Success",
                "message" => "User deleted successfully!"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "Error",
                "message" => "Failed to delete user.",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
