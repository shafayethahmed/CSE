<?php

namespace App\Http\Controllers\Faculty;
use Illuminate\Routing\Controller; 

use Illuminate\Http\Request;

class FacultyDashboardController extends Controller
{
    public function index(){
        // Return data :Total Course, Total Class, Course Assign me , Total Student Under me , Total Semester,Total Notice.
        return view('auth-faculty.faculty-dashboard');
    }
}
