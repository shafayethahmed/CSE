<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Validation\Rule;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\AlumniStudent;

class FacultyStudentsController extends Controller
{
      public function index(Request $request){
                // Faculty filter
                if(auth('faculty')->check()){
                    $faculty = auth('faculty')->user();
                    $semesters = Supervisor::where('faculty_id', $faculty->id) ->pluck('semester');
                    // $query->whereIn('semester', $semesters);
                    $query = Student::query()->whereIn('semester',$semesters);
                
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

            public function show(Student $student){
              //Information about Student Profile.
              return view('auth-faculty.students.show',compact('student'));
            }


            public function edit(Student $student){
               return view('auth-faculty.students.edit',compact('student'));
            }


            public function update(Request $request, Student $student){
                 try {
                // Validation
                $validated = $request->validate([
                    'academicId' => [
                        'required',
                        'string',
                        'max:20',
                        Rule::unique('students','academicId')->ignore($student->id),
                    ],

                    'name' => 'required|string|max:255',
                    'session' => 'required|in:summer,spring',
                    'admissionYear' => 'required|digits:4',
                    'semester' => 'required|in:1-1,1-2,2-1,2-2,3-1,3-2,4-1,4-2',
                    'status' => 'required|in:ongoing,onhold,graduated',
                    'email' => [
                        'required',
                        'email',
                        'max:255',
                        Rule::unique('students','email')->ignore($student->id),
                    ],
                    'mobile' => [
                        'required',
                        'string',
                        'max:15',
                        Rule::unique('students','mobile')->ignore($student->id),
                    ],
                    'dob' => 'required|date',
                    'address' => 'required|string',
                ]);
                  //Before Update if Status is Passed it's need to move student as ex-atudent or alumni: 
                if ($validated['status'] === 'graduated') {
                    //  Save to alumni
                    AlumniStudent::create([
                        'academicId' => $student->academicId,
                        'name' => $student->name,
                        'email' => $student->email,
                        'mobile' => $student->mobile,
                        'session' => $student->session,
                        'admissionYear' => $student->admissionYear,
                        'passedyear' => now()->year ,
                        'dob' => $student->dob,
                        'address' => $student->address,
                    ]);

                    // Delete image from storage
                  $fullPath = storage_path('app/private/' . $student->path);
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                    //  Delete student
                    $student->delete();
                    return redirect()->route('faculty.students')->with('success', 'Student moved to Alumni and image deleted.');
                }
                //  Update Data
                $student->update($validated);
                // Redirect Success
                return redirect()->route('faculty.students')->with('success', 'Student Updated Successfully.');
                } catch (\Exception $e) {
                // Redirect with error
                return redirect()->back()->with('error', $e->getMessage())->withInput();
              }
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
