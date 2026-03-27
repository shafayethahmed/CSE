<?php

namespace App\Http\Controllers;
use App\Models\AlumniStudent;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
public function index(Request $request){
    $query = Student::query();
    // Search use id and name
    if ($request->filled('searchInput')) {
        $query->where(function($q) use ($request){
            $q->where('academicId', 'like', '%' . $request->searchInput . '%')
              ->orWhere('name', 'like', '%' . $request->searchInput . '%');
        });
    }
    //  Filters
    if ($request->filled('sessionSelect')) {
        $query->where('session', $request->sessionSelect);
    }

    if ($request->filled('semesterSelect')) {
        $query->where('semester', $request->semesterSelect);
    }

    if ($request->filled('admityear')) {
        $query->where('admissionYear', $request->admityear);
    }

    // Pagination
    $students = $query->paginate(10)->withQueryString();

    // ⚡ AJAX response
    if ($request->ajax()) {
        return view('students.partials.table', compact('students'))->render();
    }

    return view('students.index', compact('students'));
}

//create Form: 
  public function create(){
    return view('students.create');
  }



    //Storing the Student Information: 
    public function store(Request $request){
        //Process Student data for insert.
        $validated = $request->validate([
                'academicId'   => 'required|string|max:20|unique:students,academicId',
                'name'         => 'required|string|max:255',
                'session'      => 'required|in:summer,spring',
                'admissionYear'=> 'required|digits:4',
                'semester'     => 'required|in:1-1,1-2,2-1,2-2,3-1,3-2,4-1,4-2',
                'email'        => 'required|email|max:255|unique:students,email',
                'mobile'       => 'required|string|max:15|unique:students,mobile',
                'picture'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'dob'          => 'required|date',
                'address'      => 'required|string',
            ]);
           
            //path catch: 
            $path = $request->file('picture')->store('students', 'local');  
            // Try-catch logic for student assign:
            try{
                Student::create([
                      'academicId' => $validated['academicId'],
                      'name' => $validated['name'],
                      'session' => $validated['session'],
                      'admissionYear' => $validated['admissionYear'],
                      'semester' => $validated['semester'],
                      'email' => $validated['email'],
                      'mobile' => $validated['mobile'],
                      'dob' => $validated['dob'],
                      'path' => $path,
                      'address' => $validated['address'],
                ]);
             return redirect()->route('students.index')->with('success','Student Inserted Successfully.');
            } catch(\Exception $e){
                return redirect()->back()->with('error','Something went wrong!')->withInput();
            }
    } 

    //Edit form display for student:
    public function edit(Student $student){
        return view('students.edit',compact('student')); //Need to assign the Student Edit Form.
    }
   


    //Information View Form for Student
    public function show(Student $student){
        //Information about Student Profile.
        return view('students.show',compact('student'));
    }
    
    //Student profile update.
    public function update(Request $request, Student $student)
        {
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
                    return redirect()->route('students.index')->with('success', 'Student moved to Alumni and image deleted.');
                }
                //  Update Data
                $student->update($validated);
                // Redirect Success
                return redirect()->route('students.index')->with('success', 'Student Updated Successfully.');
                } catch (\Exception $e) {
                // Redirect with error
                return redirect()->back()->with('error', $e->getMessage())->withInput();
            }
        }

     public function showImage($id)
    {
        $student = Student::findOrFail($id);
        if (!Storage::disk('local')->exists($student->path)) {
            abort(404);
        }
        return response()->file(
            storage_path('app/private/' . $student->path)
        );
    }
  
    

    //Function for Delete the student: 
        public function destroy(Student $student){
            $fullPath = storage_path('app/private/' . $student->path);
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
             }
             $student->delete();
             return redirect()->back()->with('success','Student Data & Picture Deleted Successfully!');
        }


}
