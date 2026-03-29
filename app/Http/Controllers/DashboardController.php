<?php

namespace App\Http\Controllers;

use App\Models\AlumniStudent;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\FacultyCourse;
use App\Models\Notice;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index(Request $request)
        {
            // User / Faculty / Staff 
            $totalUsers = User::count();
            $totalActiveUsers = User::where('status','active')->count();
            $totalStaffs = User::where('role','staff')->count();
            $totalFaculties = Faculty::count();
            $totalActiveFaculties = Faculty::where('faculty_status','active')->count();
            $totalInActiveFaculties = Faculty::where('faculty_status','inactive')->count();

            // Student/Alumni Student
            $totalStudents = Student::count();
            $totalOngoingStudents = Student::where('status','ongoing')->count(); 
            $totalAlumniStudents = AlumniStudent::count(); 

            // Others
            $totalNotices = Notice::count();
            $totalCourses = Course::count();

            // Assigned / Unassigned course count
            $assignedFacultyToCourseCount = FacultyCourse::whereNotNull('faculty_id')->count();
            $unassignedFacultyToCourseCount = FacultyCourse::whereNull('faculty_id')->count();
            

            //Last 5 students: 
            $latestStudents = Student::latest()->take(5)->get();
            $notice = Notice::latest()->first();
            return view('dashboard', compact(
                'totalUsers',
                'totalActiveUsers',
                'totalStaffs',
                'totalFaculties',
                'totalActiveFaculties',
                'totalInActiveFaculties',
                'totalStudents',
                'totalOngoingStudents',
                'totalAlumniStudents',
                'totalNotices',
                'totalCourses',
                'assignedFacultyToCourseCount',
                'unassignedFacultyToCourseCount',
                'latestStudents',
                'notice'
            ));
        }
}
