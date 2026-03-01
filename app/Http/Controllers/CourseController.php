<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
    public function store(Request $request){
        //Process Student data for insert.
        $validated= $request->validate([
            'course_code' => 'required|string|unique:courses,course_code',          'course_title' => 'required|string',
          'course_credit' => 'required|in:1.0,1.5,2.0,2.5,3.0,3.5,4.0,4.5,5.0',
          'semester' => 'required|in:1-1,1-2,2-1,2-2,3-1,3-2,4-1,4-2',
           'course_type'   => 'required|in:theory,lab,project',
        ]);
        
        //After Validation Data Insertion Part: 
        try {
            Course::create([
            //Inserting the Value: 
            'course_code' => strtoupper($validated['course_code']),
            'course_title' => $validated['course_title'],
            'course_credit' => $validated['course_credit'],
            'semester' => $validated['semester'],
            'course_type'   => $validated['course_type'],
            ]);

            return redirect()->route('courses.index')->with('success','Course Created Successfully');
        } catch (\Throwable $th) {
            return redirect()->route('courses.index')->with('error','Something went wrong while creating the course.');
        }
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
    
    //Course Teacher Assign:
    public function viewAssignCourseTeacher(){
      return view('courses.course-teacher-assign');
    }
}
