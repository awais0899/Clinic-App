<?php   

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Register a new user and return the user data with an API token.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        
        // Create the new user
        $user = User::create($data);
        
        // Optionally, you can log the user in immediately
        // auth()->login($user);
        
        // Issue a token for the user
        $token = $user->createToken('API Token')->plainTextToken;
        
        // Return the user and token as a JSON response
        return response()->json([
            'message' => 'Registration successful.',
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
