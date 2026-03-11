<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyCourseController extends Controller
{
    public function index(){
        //rerturn the view first.
        return view('courses.course-teacher');
    }

    public function create(){
        return view('courses.course-teacher-assign');
    }
}
