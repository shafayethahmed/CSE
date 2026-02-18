<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    $users = [
        (object)[
            'id' => 1,
            'name' => 'Shafayeth Ahmed',
            'email' => 'dev.shafayeth@gmail.com',
            'role' => 'Admin',
            'status' => 'Active',
        ],
        (object)[
            'id' => 2,
            'name' => 'Rahim Khan',
            'email' => 'rahim@example.com',
            'role' => 'Teacher',
            'status' => 'Active',
        ],
        (object)[
            'id' => 3,
            'name' => 'Karim Uddin',
            'email' => 'karim@example.com',
            'role' => 'Staff',
            'status' => 'Inactive',
        ],
    ];

    return view('users.index', compact('users'));
}

     //student Create Form: 
     public function create(){
       return view('users.create');
     }

    //Storing the Student Information: 
    public function store(){
        //Process Student data for insert.
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
