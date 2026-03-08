<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class CourseController extends Controller
{
      public function index(Request $request){
           $query = Course::query();
             if($request->search){
                $value = trim($request->search);
                $query->where('course_code','like',"%$value%")
                ->orWhere('course_title','like',"%$value%");
             }
           $courses = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
          return view('courses.index',compact('courses'));  //Index Page Display.
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
           'course_type'   => 'required|in:theory,sessional,project',
        ]);
        
        //After Validation Data Insertion Part: 
        try {
            Course::create([
            //Inserting the Value: 
            'course_code' => strtoupper($validated['course_code']),
            'course_title' => $validated['course_title'],
            'course_credit' => $validated['course_credit'],
            'course_type'   => $validated['course_type'],
            ]);

            return redirect()->route('courses.index')->with('success','Course Created Successfully');
        } catch (\Throwable $th) {
            return redirect()->route('courses.index')->with('error','Something went wrong while creating the course.');
        }
    } 

    //Edit form display for Course:
    public function edit(Course $course){
        return view('courses.edit',compact('course')); 
    }

    // Course update.
        public function update(Request $request, Course $course)
        {
            // Validation first (important)
            $validated = $request->validate([
                'course_code'   => 'required|string',
                'course_title'  => 'required|string',
                'course_credit' => 'required|in:1.0,1.5,2.0,2.5,3.0,3.5,4.0,4.5,5.0',
                'course_type'   => 'required|in:theory,lab,project',
            ]);

            try {
                // Update only selected course
                $course->update($validated);

                return redirect()->route('courses.index')
                    ->with('success', 'Course Updated Successfully');
            } catch (\Throwable $th) {
                return redirect()->route('courses.index')
                    ->with('error', 'Something went wrong while updating.');
            }
        }
    
    // Course Delete :
     public function destroy( Course $course){
        try{
            $course->delete();
            return redirect()->route('courses.index')->with('success','Course Deleted Successfully!');
        }catch( \Exception $e){
          return redirect()->route('courses.index')->with('error','Something went wrong while deleteing.');
        }
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
