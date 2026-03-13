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

    // Latest Course Fatch:
     public function fetchLatestCourses(Request $request)
        {
            $courseIds = Course::pluck('id');
             $addedCount = 0; // counter for newly added courses
            foreach ($courseIds as $id) {
                $exists = FacultyCourse::where('course_id', $id)->exists();
                if (!$exists) {
                    FacultyCourse::create([
                        'course_id' => $id,
                        'faculty_id' => null, // initially no faculty assigned
                    ]);
                     $addedCount++; // increment count
                }
            }
            return redirect()->route('courses.faculty-taught')->with('success',$addedCount .' New Course Fetched.');
        }

   //function for diplaying isnidividual course teacher form edit: 
   public function edit($id)
    {    
         $facultyCourse = FacultyCourse::with(['course', 'faculty'])->findOrFail($id);
         $faculties = Faculty::all();
         return view('courses.course-teacher-edit', compact('facultyCourse','faculties'));
    }

    //Function for Update The Faculty Coure Taught: 
    public function update(Request $request, $id)
{
    try {

        $request->validate([
            'course_id'  => 'required|exists:courses,id',
            'faculty_id' => 'required|exists:faculties,id',
        ],[
            'course_id.exists'  => 'Course Not Found!',
            'faculty_id.exists' => 'Faculty Not Found!',
        ]);

        $facultyCourse = FacultyCourse::findOrFail($id);

        $facultyCourse->faculty_id = $request->faculty_id;
        $facultyCourse->save();

        return redirect()->route('courses.faculty-taught')
        ->with('success','Course Teacher updated successfully');

    } catch(\Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
    }
}
}
