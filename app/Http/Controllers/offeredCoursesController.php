<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class offeredCoursesController extends Controller
{
    //Offer course page handler: 
    public function index(){
        return view('courses.offered-course-curriculam');
    }

    //Offer Course Create :
    public function create(){
        $courses = Course::all();
        return view('courses.offered-course-attachment',compact('courses'));
    }
}
