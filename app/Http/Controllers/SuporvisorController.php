<?php

namespace App\Http\Controllers;
      use Illuminate\Validation\Rule;

use App\Models\Faculty;
use App\Models\Supervisor;
use Exception;
use Illuminate\Http\Request;

class SuporvisorController extends Controller
{
  public function index(){
   $batchSupervisor =  Supervisor::all();
    return view('supervisor.index',compact('batchSupervisor'));
  }
  //This Controller need to show the data:
 public function searchFaculty(Request $request)
  {
      $faculty = Faculty::where('email', $request->email)->first();

      if(!$faculty){
          return response()->json(['status' => 'error']);
      }

      return response()->json([
          'status' => 'success',
          'data' => $faculty
      ]);
  }  

  public function store(Request $request){
      // semester,faculty_id
     $validated =  $request->validate([
          'faculty_id' => [
              'required',
              'exists:faculties,id,faculty_status,active',
          ],
          'semester' => [
              'required',
              Rule::in(['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2']),
              Rule::unique('batch_supervisor')->where(function ($query) use ($request) {
                  return $query->where('faculty_id', $request->faculty_id);
              }),
          ],
      ]);

      try{
        Supervisor::create([
          'faculty_id' => $validated['faculty_id'],
          'semester' => $validated['semester'],
        ]);
        return redirect()->route('supervisor.index')->with('success','Supervisor Assigned Successfully');
       }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => 'Something went wrong while assigning the supervisor. Please try again.'])->withInput();
       }
   }
}
