<?php

namespace App\Http\Controllers\Faculty;
use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class FacultyPasswordController extends Controller
{      
    public function index(){
        return view('auth-faculty.change-password');
    }
    //For faculty Dashboard Password managing.
     public function changePassword(Request $request)
    {
        // Validation
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        /** @var \App\Models\Faculty $faculty */
        $faculty = auth('faculty')->user();

        //  Check current password
        if (!Hash::check($request->current_password, $faculty->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect'
            ]);
        }

        //  Update password
        $faculty->password = Hash::make($request->new_password);
        $faculty->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
