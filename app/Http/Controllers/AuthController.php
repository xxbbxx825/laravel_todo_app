<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    // public function register(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:100',
    //         'email' => 'required|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|max:255|confirmed',
    //         'password_confirmation' => 'required|string|min:8|max:255',
    //     ]);

    //     if($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'messages' => $validator->messages()
    //         ], 200);
    //     }

    //     $user = new User;
    //     $user->fill($request->all());
    //     $user->password = bcrypt($request->password);
    //     $user->save();

    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $user
    //     ], 200);
    // }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
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
        try {
            return $this->respondWithToken(auth()->refresh());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
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
