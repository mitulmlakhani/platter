<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\ChangePasswordRequest;

class AuthController extends BaseApiController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->guard = "admin_api";
    }

    protected function guard(){
        return Auth::guard('admin_api');
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if(!$token = auth($this->guard)->attempt($credentials)){
            return Self::sendError(new \StdClass(), 'Invalid Username and password.', 400);
        }

        $web = auth($this->guard)->user();
        return Self::sendResponse(['name' => $web->name, 'email' => $web->email, 'token' => $token], 'Login Success');
    }

    public function changePassword(ChangePasswordRequest $request) {
        $user = auth($this->guard)->user();
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return Self::sendResponse([], 'Password changed successfully.');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth($this->guard)->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth($this->guard)->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
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
        // return Self::sendResponse(['name' => $web->name, 'email' => $auth->email, 'token' => $token], 'Login Success');
        // }
        // return Self::sendError(new \StdClass(), 'Invalid Username and password.', 400);
    }
}
