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
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
      throw ValidationException::withMessages([
        'email' => ['The provided email is incorrect.'],
      ]);
    }
    if (!Hash::check($request->password, $user->password)) {
      throw ValidationException::withMessages([
        'password' => ['The provided password is incorrect.'],
      ]);
    }

    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
      'token' => $token,
      'user' => new UserResource($user),
    ]);
  }

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:20',
      'email' => 'required|string|email|unique:users',
      'password' => 'required',
    ]);
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => 'user',
    ]);
    $token = $user->createToken('api_token')->plainTextToken;
    return response()->json([
      'token' => $token,
      'user' => new UserResource($user),
    ]);
  }

  public function logout(Request $request)
  {
    $request->user()->tokens()->delete();
    return response()->json([
      'message' => 'Logged out successfully',
    ]);
  }
}
