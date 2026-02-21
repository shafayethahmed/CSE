<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
      
     //user index
      public function index(Request $request){
        
          $users = User::all('*');
          return view('users.index',compact('users'));
      }

     //student Create Form: 
     public function create(){
       return view('users.create');
     }

    //Storing the Student Information: 
    public function store(Request $request){
        //Process Student data for insert.
       $validated = $request->validate([
            'name'   => 'required|string',
            'email'  => 'required|email|unique:users,email',
            'mobile' => 'required|regex:/^01[3-9]\d{8}$/|unique:users,mobile',
            'role'   => 'required|in:staff,user,department-head',
        ]);

        // Validated Data insertion to the Table: 
        try{
             User::create([
           'name' => $validated['name'],
           'email' => $validated['email'],
           'mobile' => $validated['mobile'],
           'role' => $validated['role'],
           'password' => Hash::make('12345678'),
        ]);
        //Return Success to the index.
          return redirect()->route('users.index')->with('success','User Created Successfully');
        } catch(\Exception $e){
             return redirect()->back()->with('error', 'User creation failed!');
        }
    } 

    //Edit form display for student:
    public function edit(){
        return view('users.edit'); //Need to assign the Student Edit Form.
    }

    //Information View Form for Student
    public function show(){
        //Information about Student Profile.
        return view('');
    }
    
    //Student profile update.
    public function update(){
        //Update Process logic need to implement here.
    }


}
