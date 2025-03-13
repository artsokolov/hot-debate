<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function signUp(SignUpRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::whereEmail($validated['email'])
            ->orWhere('name', $validated['username'])
            ->first();
        if ($user) {
            return response()->json([
                'message' => 'User already with such email or username already exists',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var User $user */
        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'token' => $user->createToken('default')->plainTextToken
        ]);
    }

    public function signIn(SignInRequest $request): JsonResponse
    {
        $validated = $request->validated();

        /** @var User $user */
        $user = User::whereEmail($validated['email'])->first();
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'token' => $user->createToken('default')->plainTextToken
        ]);
    }
}
