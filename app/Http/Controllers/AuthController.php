<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\User;

class AuthController extends Controller
{
    //public $loginAfterSignUp = true;
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($credentials)) {

            return response()->json(['error' => 'Email or Password not found']);
        }
        return response()->json([
            'message' => 'You are logged in successfully.',
            'token' => $token
        ]);

    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|max:15'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();


        return response()->json([
            'message' => 'You are registered successfully.',
            'user' => $user
        ]);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return response()->json(['message' => 'User logged out successfully.']);

        } catch (JWTException $e) {
            response()->json([
                'message' => 'Oops, user can\'t be logged out.'
            ]);
        }


    }

}
