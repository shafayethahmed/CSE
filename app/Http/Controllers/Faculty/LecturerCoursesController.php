<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Course;
use App\Models\FacultyCourse;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;
use Nette\Utils\Json;
use PHPUnit\Util\Json as UtilJson;

class LecturerCoursesController extends Controller
{
    //it's need to reutrn data based on faculty id assigned with the courses.
    public function index(Request $request){
    $faculty = auth()->guard('faculty')->user();
    if($faculty){
         $coursesList =  $faculty->courses;
        return view('auth-faculty.courses.index',compact('coursesList'));
    }
}
}
