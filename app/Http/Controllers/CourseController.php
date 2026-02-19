<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
      public function index(){
          return view('courses.index');  //Index Page Display.
      }
     
     //student Create Form: 
     public function create(){
        return view('courses.create');//Need to assign the Student Create Form.
     }

    //Storing the Student Information: 
    public function store(){
        //Process Student data for insert.
    } 

    //Edit form display for student:
    public function edit(){
        return view(''); //Need to assign the Student Edit Form.
    }

    //Information View Form for Student
    public function show(){
        //Information about Student Profile.
        return view('students.show');
    }
    
    //Student profile update.
    public function update(){
        //Update Process logic need to implement here.
    }

}
