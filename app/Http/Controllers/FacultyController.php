<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
        public function index(){
         return view('faculty.index');
      }
     
     //student Create Form: 
     public function create(){
       return view('faculty.create');
     }
     
     //Searched Data 
    public function search(Request $request)
    {
        // Initialize variable as null first
        $user = null;
        // Search logic
        $search = $request->searchval;
        // Perform search
            if ($search) {
                $user = User::where('email', $search)->first();
            }
        if (!$user) {
            return redirect()->back()->with('error', 'User email not found!');
        }
            // Return blade with result
            return view('faculty.create', compact('user'));
    }

    //Storing the Student Information: 
    public function store(){
        //Process Student data for insert.
    } 

    //Edit form display for student:
    public function edit(){
        // return view(''); //Need to assign the Student Edit Form.
        //Edit Form is Ready just need to assign with logic.
    }

    //Information View Form for Student
    public function show(){
        //Information about Student Profile.
      
    }
    
    //Student profile update.
    public function update(){
        //Update Process logic need to implement here.
    }


}
