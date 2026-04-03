<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//User used here as var name
class FacultyController extends Controller
{
       public function index(Request $request)
            {
                $faculties = Faculty::query();

                if ($request->search) {
                    $faculties->where(function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                    });
                }

                if ($request->filter) {
                    $faculties->where('faculty_status', $request->filter);
                }

                $faculties = $faculties->latest()->paginate(15)->withQueryString();

                if ($request->ajax()) {
                    return view('faculty.partials.table', compact('faculties'))->render();
                }

                return view('faculty.index', compact('faculties'));
            }
     //student Create Form: 
     public function create(){
       return view('faculty.create');
     }
     
     //Searched Data 
   public function search(Request $request)
{
    // Validate input
    $request->validate([
        'searchval' => 'required|email'
    ]);

    $search = $request->searchval;

    // Search user
    $user = User::where('email', $search)->first();

    // Check user exists
    if (!$user) {
        return redirect()->back()->with('error', 'User email not found!');
    }

    // Check inactive
    if ($user->status === "inactive") {
        return redirect()->back()->with('error', 'User is Inactive.');
    }

    // Return view
    return view('faculty.create', compact('user'));
}



    //Storing the Student Information: 
  public function store(Request $request){
    try{
        // 1️ Validate
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:faculties,email',
            'user_mobile' => 'required|regex:/^01[3-9]\d{8}$/|unique:faculties,mobile',
            'designation' => 'required|string|max:100',
            'credit_limit' => 'required|integer|min:18|max:30',
            'bachelor_degree' => 'nullable|string|max:255',
            'bachelor_university' => 'nullable|string|max:255',
            'bachelor_cgpa' => 'nullable|numeric',
            'masters_degree' => 'nullable|string|max:255',
            'masters_university' => 'nullable|string|max:255',
            'masters_cgpa' => 'nullable|numeric',
        ]);

        // 2️Generate faculty_id
        $year = Carbon::now()->format('Y');
        // Get last faculty ID for this year
        $lastFaculty = Faculty::where('faculty_id', 'like', $year.'%')
                              ->orderBy('faculty_id', 'desc')
                              ->first();

        if($lastFaculty){
            // Extract serial number from last faculty_id
            $lastSerial = intval(substr($lastFaculty->faculty_id, 4)); // '2026001' => 001
            $newSerial = str_pad($lastSerial + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $newSerial = '001';
        }

        $facultyId = $year . $newSerial; // e.g., 2026001

        //  Create faculty
        Faculty::create([
            'faculty_id' => $facultyId,
            'name' => $validated['user_name'],
            'email' => $validated['user_email'],
            'mobile' => $validated['user_mobile'],
            'designation' => $validated['designation'] ?? 'faculty',
            'credit_limit' => $validated['credit_limit'],
            'bachelor_degree' => $validated['bachelor_degree'],
            'bachelor_university' => $validated['bachelor_university'],
            'bachelor_cgpa' => $validated['bachelor_cgpa'],
            'master_degree' => $validated['masters_degree'],
            'master_university' => $validated['masters_university'],
            'master_cgpa' => $validated['masters_cgpa'],
            'password' => Hash::make('12345678'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Faculty assigned successfully'
        ]);

    }catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

    //Edit form display for student:
    public function edit( Faculty $faculty){
        return view('faculty.edit',compact('faculty'));
        // return view(''); //Need to assign the Student Edit Form.
        //Edit Form is Ready just need to assign with logic.
    }

    //Information View Form for Student
    public function show(Faculty $faculty){
        $facultyCourseTaken = $faculty->courses;
         return view('faculty.show',compact('faculty','facultyCourseTaken'));
    }
    
    //Student profile update.
    public function update(){
        //Update Process logic need to implement here.
    }

    //Destroy the faculty: 
    public function destroy(Faculty $faculty){
        $faculty->delete();
        return redirect()->route('faculty.index')->with('success', 'Faculty deleted successfully!');
    }
}
