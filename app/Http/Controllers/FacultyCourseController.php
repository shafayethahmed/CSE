<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\FacultyCourse;
use Illuminate\Http\Request;

class FacultyCourseController extends Controller
{
    public function index(Request $request){
         $status = $request->status;

    $query = FacultyCourse::with(['course','faculty']);

    if ($status == 'assigned') {

        $query->whereNotNull('faculty_id');

    } elseif ($status == 'null') {

        $query->whereNull('faculty_id');

    }

    $facultyCourses = $query->get();

    return view('courses.course-teacher', compact('facultyCourses'));
    }

    public function create(){
        //Fetching The Faculty List:
        $faculty = Faculty::all();
        $courses = Course::all();
        return view('courses.course-teacher-assign',compact('faculty','courses'));
    }

    //Function for store course-faculty:
        public function store(Request $request){
          //Reciving the filter data: 
          $validated = $request->validate([
            'course_id' => 'required|exists:courses,id|unique:faculty_course_taught,course_id,' . $request->course_id . ',course_id',
            'faculty_id' => 'required|exists:faculties,id',
          ],
          [
            'course_id.unique' => 'This course is already assigned to a faculty.',
          ]);

          //Course Attachment by Try/Catch Block: 
          try{
               //Ensuring the Faculty Course Taken Credit Limit: 
              $facultyCreditLimit = Faculty::find($validated['faculty_id'])->credit_limit;
              $facultyCreditInfomation = Faculty::find($validated['faculty_id'])->courses->sum('course_credit');
            // Latest Course Credit: 
              $latestCourseCredit = Course::find($validated['course_id'])->course_credit;
              $withLatestCourse = $facultyCreditInfomation + $latestCourseCredit;
              //Checking Logic
              if ($withLatestCourse > $facultyCreditLimit) {
                    return redirect()->back()->with('error','Faculty Credit Limit Exceeded! Cannot assign this course.');
               }
              FacultyCourse::create([
              'course_id' => $validated['course_id'],
              'faculty_id' => $validated['faculty_id'],
            ]);
            return redirect()->route('courses.faculty-taught')->with('success','Course Teacher Assigned Successfully.');
            }catch ( \Exception $e){
             return redirect()->back()->with('error','This course is already assigned to a faculty.');
          }
        }
}
