<?php

namespace App\Http\Controllers\Faculty;
use Illuminate\Routing\Controller; 
use App\Models\Supervisor;
use App\Models\Student;
use Illuminate\Http\Request;

class FacultyDashboardController extends Controller
{
    public function index(){
        // Return data :Total Course, Total Class, Course Assign me , Total Student Under me , Total Semester,Total Notice.
        if(auth('faculty')->check()){
                    $faculty = auth('faculty')->user();
                    $semesters = Supervisor::where('faculty_id', $faculty->id) ->pluck('semester');
                    // $query->whereIn('semester', $semesters);
                    $TotalStudentUnderMe = Student::query()->whereIn('semester',$semesters)->count();
                    $TotalCoursesUnderMe = $faculty->courses->count();
                    $TotalCreditLimit = auth('faculty')->user()->credit_limit;
                    $TotalCreditTaken = $faculty->courses->sum('course_credit');
                    return view('auth-faculty.faculty-dashboard',compact('TotalCoursesUnderMe','TotalStudentUnderMe','TotalCreditLimit','TotalCreditTaken'));
         }
   }
}
