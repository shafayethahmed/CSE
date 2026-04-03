<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\OfferedCourses;
use Exception;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use PHPUnit\Framework\Constraint\Count;

class offeredCoursesController extends Controller
{
    //Offer course page handler: 
   public function index(Request $request)
{    
    // default semester
    $offeredSemester = $request->filterSemester ?? '1-1';

    $query = OfferedCourses::query();
    $query->where('semester', $offeredSemester);
    
    // Credit Sum
    // $totalCredit = (clone $query)->sum('course_credit');

    $offeredCourses = $query->paginate(10)->withQueryString();

    if ($request->ajax()) {
        // return view('courses.partial.offered-course', compact('offeredCourses','totalCredit','offeredSemester'))->render();
        return view('courses.partial.offered-course', compact('offeredCourses','offeredSemester'))->render();
    }

    return view('courses.offered-course-curriculam', compact('offeredCourses','offeredSemester'));
    // return view('courses.offered-course-curriculam', compact('offeredCourses','totalCredit','offeredSemester'));
}

    //Offer Course Create :
    public function create(){
        //In Next Update we will back offered course table for display courses that already assigned.
        $courses = Course::all();
        return view('courses.offered-course-attachment',compact('courses'));
    }

    //Store Function For Offered Course Prevent :
    public function store(Request $request)
        {
            if (!$request->courses) {
                return redirect()->back()->with('error', 'Please select at least one course');
            }
            $data = [];
            foreach ($request->courses as $cid) {
                // duplicate check (optional but important)
                $exists = OfferedCourses::where('course_id', $cid)
                            ->where('semester', $request->semester)
                            ->exists();
                if (!$exists) {
                    $data[] = [
                        'course_id' => $cid,
                        'semester' => $request->semester,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            try {
                if (!empty($data)) {
                    OfferedCourses::insert($data);
                }
                return redirect()->route('courses.offered-curriculum')
                    ->with('success', 'Offered Course Inserted Successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Internal Error!');
            }
        }

    // Function for diplay already assigned courses to the semester:
          public function alreadyOfferedCourses(Request $request)
            {
                $semester = $request->filterSemesterValue ?? '1-1';

                $assignedCourses = OfferedCourses::with('course')
                    ->where('semester', $semester)
                    ->get()
                    ->filter(function ($item) {
                        return $item->course != null; 
                    })
                    ->values(); // reindex
                return response()->json([
                    'courses' => $assignedCourses,
                ]);
            }
    //Delete course from existance Data: 
        public function deleteExistedCourse($id){
            //Reciving the id:
            try{
                $course = OfferedCourses::findOrFail($id);
                $course->delete();
                return response()->json([
                    'status' => true,
                   'message'=> "Course Removed",
                ],200);
            } catch(\Exception $e){
                return response()->json([
                     'status' => false,
                     'message'=> "Course Remove Failed.",
                ],500);
            }
        }


}