<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * Login a user and return a token.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user's role is allowed to access the system
            if (!in_array($user->role, ['owner', 'therapist', 'patient'])) {
                return response()->json([
                    'message' => 'You are not authorized to access this system.',
                ], 403); // Forbidden if role is not in the allowed list
            }

            // Generate the token with a name specific to the user's session or role
            $token = $user->createToken('API Token for ' . $user->role)->plainTextToken;

            // Return the user and token
            return response()->json([
                'message' => 'Login successful.',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // If authentication fails, return an error
        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    /**
     * Logout a user and revoke their tokens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoke the user's current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ], 200);
    }
}
