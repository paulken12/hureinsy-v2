<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function show() {
        return view('auth.passwords.password');
    }

    public function change(Request $request) {
        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()
                ->back()
                ->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()
                ->back()
                ->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        //Validate the current password if correct
        //validate the required new password
        $this->validate($request, [
            'current-password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password ans save
        $user = Auth::user();
        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();

        //return to change password page
        return redirect()->back()
            ->with('success', 'Your new password is now set!');

    }
}
