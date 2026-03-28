<?php

namespace App\Http\Controllers;

use App\Models\AlumniStudent;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request){
            $query = AlumniStudent::query();

            if($request->filled('searchInput') || $request->filled('passedYear')){
                $query->where(function($q) use ($request){
                    $q->where('academicId','like',"%".$request->searchInput."%")
                    ->orWhere('name','like',"%".$request->searchInput."%")
                    ->orWhere('email','like',"%".$request->searchInput."%");
                });
            }

            $alumni = $query->paginate(10)->withQueryString();

            if($request->ajax()){
                return view('alumni.partials.table', compact('alumni'))->render();
            }

            return view('alumni.index', compact('alumni'));
        }

        public function destroy(AlumniStudent $alumni){
             $alumni->delete();
             return redirect()->back()->with('success','Record Deleted Successfully.');
        }
}
