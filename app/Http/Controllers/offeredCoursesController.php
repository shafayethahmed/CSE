<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\OfferedCourses;
use Exception;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class offeredCoursesController extends Controller
{
    //Offer course page handler: 
    public function index(){
        return view('courses.offered-course-curriculam');
    }

    //Offer Course Create :
    public function create(){
        //In Next Update we will back offered course table for display courses that already assigned.
        $courses = Course::all();
        return view('courses.offered-course-attachment',compact('courses'));
    }

    //Store Function For Offered Course Prevent :
    public function store(Request $request){
     $data = []; //For preventing null error!
      if(!$request->courses){
            return redirect()->back()->with('error','Please select at least one course');
        }
    foreach ($request->courses as $cid) {
        $course = Course::find($cid);
        //Multiple Condition Run 1 time.
        $data[] = [
            'course_code' => $course->course_code,
            'course_title' => $course->course_title,
            'course_credit' => $course->course_credit,
            'semester' => $request->semester
        ];
        }
        try{
             OfferedCourses::insert($data);   //inserting the course.
             return redirect()->route('courses.offered-curriculum')->with('success','Offered Course Inserted');
        } catch(\Exception $e){
            return redirect()->back()->with('error','Internal Error!');
        }
        
    }
}