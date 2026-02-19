<?php

namespace App\Http\Controllers;

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
     // Mock users (for testing)
    $users = [
        [
            'id' => 101,
            'name' => 'Dr. Rahim Uddin',
            'email' => 'rahim@university.edu'
        ],
        [
            'id' => 102,
            'name' => 'Shafayeth Ahmed',
            'email' => 'shafayeth@gmail.com'
        ],
        [
            'id' => 103,
            'name' => 'Farhana Akter',
            'email' => 'farhana@gmail.com'
        ]
    ];

    $search =$request->searchval;
    $user = null;

    // Search logic
    if ($search) {
        foreach ($users as $u) {
            if ($u['id'] == $search || $u['email'] == $search) {
                $user = (object) $u; // convert to object like Eloquent
                break;
            }
        }
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
