<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FacultyAuthController extends Controller
{
    public function facultyLogin(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'faculty_id' => 'required',
            'password' => 'required',
        ]);

        // Attempt login using the 'faculty' guard
        if (Auth::guard('faculty')->attempt($credentials)) {

            $faculty = Auth::guard('faculty')->user(); // get logged-in faculty

            // Check if faculty is active
            if ($faculty->faculty_status === "active") {
                $request->session()->regenerate(); // regenerate session
                return "This Is Faculty Dashboard!";
                //return redirect()->route('faculty.dashboard'); // redirect to dashboard
            } else {
                Auth::guard('faculty')->logout(); // log out inactive user
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->back()->with('failed', 'Faculty account is currently inactive.');
            }
        }
        // Login failed
        return redirect()->back()->with('failed', 'Wrong Faculty ID or Password.');
    }
 }
