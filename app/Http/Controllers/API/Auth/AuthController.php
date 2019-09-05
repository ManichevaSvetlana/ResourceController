<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Log in to the application with email and password.
     *
     * @return mixed
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => $credentials], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log out from the application.
     *
     * @return mixed
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out.']);
    }

    /**
     * Get json with the info about the current user.
     *
     * @return Response
     */
    protected function respondWithToken($token)
    {
        $user = auth()->user();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
