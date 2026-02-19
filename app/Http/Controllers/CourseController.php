<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
      public function index(){
          return view('courses.index');  //Index Page Display.
      }
     
     //Course Create Form: 
     public function create(){
        return view('courses.create');//Need to assign the Student Create Form.
     }

    //Storing the Course Information: 
    public function store(){
        //Process Student data for insert.
    } 

    //Edit form display for Course:
    public function edit(){
        // return view('courses.edit);
        return view('Course Edit Ui Designed Need the Backedn Implementation.'); //Need to assign the Student Edit Form.
         
    }

    // Course update.
    public function update(){
        //Update Process logic need to implement here.
    }
    
    //Curriculam Display: 
    public function viewcurriculam(){
        return view('courses.course-curriculam');
    }
    
    //Course Teacher Info:
      public function viewCourseTeacher(){
        return view('courses.course-teacher');
      }
}
