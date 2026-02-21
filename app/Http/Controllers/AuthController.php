<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    public function generalLogin(Request $request){
     //This is the Login Information.
       print($request->email);
       $request->password;
       $credential = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
       ]);

       if(Auth::attempt($credential)){
          $request->session()->regenerate();
          return redirect()->route('dashboard');
       }
         return redirect()->route('login')->with('failed','Wrong Email or Password.');
    }

}
