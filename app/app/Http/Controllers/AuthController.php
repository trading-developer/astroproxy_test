<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login']]);
//    }

    public function login(AuthRequest $request)
    {
        $token = Auth::attempt($request->validationData());

        if (!$token) {
            return response([
                'errors' => [
                    'password' => ['Invalid password']
                ]
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'user' => UserResource::make(Auth::user()),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
