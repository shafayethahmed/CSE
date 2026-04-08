<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FacultyStudentsController extends Controller
{
      public function index(Request $request){
                $query = Student::query();
                // Faculty filter
                if(auth('faculty')->check()){
                    $faculty = auth('faculty')->user();
                    $semesters = Supervisor::where('faculty_id', $faculty->id) ->pluck('semester');
                    // $query->whereIn('semester', $semesters);
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

            public function show(Student $student){
              //Information about Student Profile.
              return view('auth-faculty.students.show',compact('student'));
            }


            public function edit(Student $student){
               return view('auth-faculty.students.edit',compact('student'));
            }
          
         public function showImage($id){
             $student = Student::findOrFail($id);
        if (!Storage::disk('local')->exists($student->path)) {
            abort(404);
        }
        return response()->file(
            storage_path('app/private/' . $student->path)
        );
         }  
}
