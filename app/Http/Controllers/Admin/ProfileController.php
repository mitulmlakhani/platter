<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showChangePassword(){
        return view('admin.changepassword');
    }

    public function changePassword(ChangePasswordRequest $request) {
        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.password.change')->with('success', 'Your password has been changed.');
    }
}
