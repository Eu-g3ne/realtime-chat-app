<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  //
  public function register(RegisterRequest $request)
  {
    $this->user = User::create($request->validated());

    return response()->json([], 201);
  }

  public function login(LoginRequest $request)
  {
    if (auth('web')->attempt($request->validated())) {
      return response()->json(['token' => $request->user()->createToken('api')->plainTextToken], 200);
    } else {
      return response()->json([], 401);
    }
  }

  public function logout()
  {
    Auth::user()->tokens()->delete();

    return response()->json(['message' => 'Logout successfully'], 200);
  }
}
