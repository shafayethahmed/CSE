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
    // print_r($request->courses);
    //    print($request->semester);
       $courseInformation = $request->courses; //Reciving Coure ID.
     foreach($courseInformation as $cid){   //Searching By Course Id.
           //Try Block For Course Attachment: 
           try{
               $course = Course::find($cid);
               //Insertion the data to the offered Course:
              
               OfferedCourses::insert([
                   //Course-code,course title,offered-semester,Course_credit.
               ]);
              
           } catch( \Exception $e){
                return redirect()->route('courses.offered-curriculum')->with('error','Offered Course Assign Failed!');
           }
      }
   }
}