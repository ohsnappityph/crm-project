<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }    

    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255|unique:users',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            'password' => bcrypt($request->get('password')),
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token'=> $token,
            'token_type'=> 'bearer',
            'expires_in' => $this->guard()->factor()->getTTL() * 480
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}