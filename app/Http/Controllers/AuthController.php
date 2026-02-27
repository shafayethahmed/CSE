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

}

