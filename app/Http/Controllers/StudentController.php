<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
      public function index(){
        $students = Student::all();
        return view('students.index',compact('students'));  //Index Page Display.
      }
     
     //student Create Form: 
     public function create(){
        return view('students.create');//Need to assign the Student Create Form.
     }

    //Storing the Student Information: 
    public function store(Request $request){
        //Process Student data for insert.
        $validated = $request->validate([
                'academicId'   => 'required|string|max:20|unique:students,academicId',
                'name'         => 'required|string|max:255',
                'session'      => 'required|in:summer,spring',
                'admissionYear'=> 'required|digits:4',
                'semester'     => 'required|in:1-1,1-2,2-1,2-2,3-1,3-2,4-1,4-2',
                'email'        => 'required|email|max:255|unique:students,email',
                'mobile'       => 'required|string|max:15|unique:students,mobile',
                'dob'          => 'required|date',
                'address'      => 'required|string',
            ]);

        // Try-catch logic for student assign:
            try{
                Student::create([
                      'academicId' => $validated['academicId'],
                      'name' => $validated['name'],
                      'session' => $validated['session'],
                      'admissionYear' => $validated['admissionYear'],
                      'semester' => $validated['semester'],
                      'email' => $validated['email'],
                      'mobile' => $validated['mobile'],
                      'dob' => $validated['dob'],
                      'address' => $validated['address'],
                ]);
             return redirect()->route('students.index')->with('success','Student Inserted Successfully.');
            } catch(\Exception $e){
                return redirect()->back()->with('error','Something went wrong!')->withInput();
            }
    } 

    //Edit form display for student:
    public function edit(Student $student){
        return view('students.edit',compact('student')); //Need to assign the Student Edit Form.
    }

    //Information View Form for Student
    public function show(Student $student){
        //Information about Student Profile.
        return view('students.show',compact('student'));
    }
    
    //Student profile update.
    public function update(){
        //Update Process logic need to implement here.
    }


}
