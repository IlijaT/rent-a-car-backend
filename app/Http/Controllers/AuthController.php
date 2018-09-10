<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //$credentials = request(['email', 'password']);

        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'required',
        ]);

        if (! $token = auth()->attempt($request->all())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        //$user = User::where('email', request(['email']))->get();
        $user = User::where('email', $request->input('email'))->get();
        return $this->respondWithToken($token, $user);
    }

    public function register(Request $request)
    {
        //Log::info($request);
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'bail|required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // $user = User::create([
        //     'name' => $request->input('name') request()->get('name'),
        //     'email' => request()->get('email'),
        //     'password' => bcrypt(request()->get('password'))
        // ]);

          $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $token = JWTAuth::fromUser($user);
        $responseUser = User::where('email', $request->input('email'))->get();
        return $this->respondWithToken($token, $responseUser);
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
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
