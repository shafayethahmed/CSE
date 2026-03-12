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
}
