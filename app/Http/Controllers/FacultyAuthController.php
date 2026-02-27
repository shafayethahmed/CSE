<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FacultyAuthController extends Controller
{
    public function faculyLogin(Request $request){
        //getting the data for Ensure the Login Of Faculty: 
         //This is the Login Information.
       $request->faculty_id;
       $request->password;
       $credential = $request->validate([
         'faculty_id' => 'required',
          'password' => 'required',
       ]);

       if(Auth::guard('faculty')->attempt($credential)){
          $request->session()->regenerate();
          return "This Is From FaCulty Dashboard";
       }
         return redirect()->route('login')->with('failed','Wrong Email or Password.');
    }
 }
