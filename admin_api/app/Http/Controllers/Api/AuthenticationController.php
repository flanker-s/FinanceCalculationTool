<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserAuthenticationRequest;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'password' => [
                        'invalid credentials'
                    ]
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        $authToken = $user->createToken('auth-token', $user->ability_names)->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);
    }

    public function user(UserAuthenticationRequest $request)
    {
        $data = $request->validated();
        $user = User::QueryRequest($data)->find(request()->user()->id);
        return new UserResource($user);
    }
}
