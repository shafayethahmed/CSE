<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Routing\Controller; 

use Illuminate\Http\Request;

class FacultyStudentsController extends Controller
{
      public function index(Request $request){
                $query = Student::query();
                // Faculty filter
                if(auth('faculty')->check()){
                    $faculty = auth('faculty')->user();
                    $semesters = Supervisor::where('faculty_id', $faculty->id) ->pluck('semester');
                    $query->whereIn('semester', $semesters);
                }
                if ($request->filled('searchInput')) {
                    $query->where(function($q) use ($request){
                        $q->where('academicId', 'like', '%' . $request->searchInput . '%')
                        ->orWhere('name', 'like', '%' . $request->searchInput . '%');
                    });
                }
                // Semester filter
                if ($request->filled('semesterSelect')) {
                    $query->where('semester', $request->semesterSelect);
                }
                // Pagination
                $students = $query->paginate(10)->withQueryString();
                // AJAX
                if ($request->ajax()) {
                    return view('auth-faculty.students.partials.table', compact('students'))->render();
                }

                return view('auth-faculty.students.index', compact('students','semesters'));
            }
}
