<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\FacultyCourse;
use Illuminate\Http\Request;

class FacultyCourseController extends Controller
{
    public function index(){
        //rerturn the view first.
         $facultyCourses = FacultyCourse::with(['course','faculty'])->get();
        return view('courses.course-teacher', compact('facultyCourses'));
    }

    public function create(){
        //Fetching The Faculty List:
        $faculty = Faculty::all();
        return view('courses.course-teacher-assign',compact('faculty'));
    }
}
