<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserSettingsContoller extends Controller
{
    public function updatePassword(Request $request)
    {

        $user = Auth::user();
        //Check if the Current Password matches with what is in the database.
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            Alert::error('Error Updating on Password', 'Your current password does not match with what you provided');
            return back()->with('error', 'Your current password does not match with what you provided');
        }
        // Compare the Current Password and New Password using[strcmp function]
        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            Alert::error('Error Updating on Password', 'Your current password cannot be same with the new password');
            return back()->with('error', 'Your current password cannot be same with the new password');
        }
        if (!strcmp($request->get('new_password'), $request->get('new_password_confirmation')) == 0) {
            Alert::error('Error Updating on Password', 'New password must be the same with Confirm password');
            return back()->with('error', 'New password must be the same with Confirm password');
        }
        //Validate the Password.
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed'
        ]);
        // Save the New Password.

        $user->update([
            'password' => bcrypt($request->get('new_password')),
            'is_password_set' => true,
        ]);

        Alert::success('Updated Password',"Let's start learning!");

        $lessons = Lesson::all();

        return view('student.index', [
            'lessons' => $lessons,
        ]);
    }
}
