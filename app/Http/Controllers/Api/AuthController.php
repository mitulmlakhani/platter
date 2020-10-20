<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\ChangePasswordRequest;

class AuthController extends BaseApiController
{
    use AuthenticatesUsers;

    protected function guard(){
        return Auth::guard('web');
    }

    public function login(Request $request){
        if($this->attemptLogin($request)){
            $web = Auth::guard('web')->user();
            return Self::sendResponse(['name' => $web->name, 'email' => $web->email, 'token' => $web->createToken('SAMARTH')->accessToken], 'Login Success');
        }
        return Self::sendError(new \StdClass(), 'Invalid Username and password.', 400);
    }

    public function changePassword(ChangePasswordRequest $request) {
        $user = auth()->user();
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return Self::sendResponse([], 'Password changed successfully.');
    }

}
