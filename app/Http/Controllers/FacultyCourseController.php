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
        return view('courses.course-teacher-assign',compact('faculty'));
    }
}
