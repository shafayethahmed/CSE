<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    public function generalLogin(Request $request){
     //This is the Login Information.
       $request->email;
       $request->password;
       $credential = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
       ]);

       if(Auth::attempt($credential)){
        $userInfo = Auth::user(); // get logged-in user area
        // Check if user is active
            if ($userInfo->status === "active") {
                 $request->session()->regenerate();
                  return redirect()->route('dashboard');
            } else {
                Auth::logout(); // log out inactive user
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->back()->with('failed', 'User account is currently inactive.');
            }
        
       }
         return redirect()->route('login')->with('failed','Wrong Email or Password.');
    }

      public function logoutUserOrFaculty(Request $request)
      {
          // Logout default user
          if (Auth::check()) {
              Auth::logout();
          }

          // Logout faculty
          if (Auth::guard('faculty')->check()) {
              Auth::guard('faculty')->logout();
          }

          // Invalidate session and regenerate CSRF token
          $request->session()->invalidate();
          $request->session()->regenerateToken();

          // Redirect to login page
          return redirect('/login');
      }

}

