<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FacultyAuthController extends Controller
{
    public function facultyLogin(Request $request)
{
    $request->validate([
        'faculty_id' => 'required',
        'password' => 'required',
    ]);

    $credentials = [
        'faculty_id' => $request->faculty_id,
        'password' => $request->password, // plain password, NOT hashed
    ];

      if (Auth::guard('faculty')->attempt($credentials)) {
        $faculty = Auth::guard('faculty')->user();

        if ($faculty->faculty_status === 'active') {
            $request->session()->regenerate(); // Prevent session fixation
            //return "Faculty Dashboard";
            // Debug: Auth status check
        // dd([
        //     'faculty_logged_in' => Auth::guard('faculty')->check(),
        //     'user' => Auth::guard('faculty')->user(),
        //     'session_id' => session()->getId()
        // ]);
        return redirect()->route('faculty.dashboard');
            // return redirect()->route('faculty.dashboard');
        }

        Auth::guard('faculty')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back()->with('failed', 'Faculty account is currently inactive.');
    }


    return redirect()->back()->with('failed', 'Wrong Faculty ID or Password.');
}
 }
