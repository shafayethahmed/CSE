<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(){
        $notices = Notice::all();
        return view('notices.index',compact('notices'));
    }
    public function create(){
        return view('notices.create');
    }

    

    public function store(Request $request){
        //Storing the Notice: 
        $validated = $request->validate([
          'title' => 'required|string',
          'body' => 'required|string',
          'publisher_name' => 'required|string',
          'designation' => 'required|string',
        ]);
       
        // Store Notice:
        try{
         //For Notice Id: 
            $noticeID = 'CSE-' . date('Y-m') . '-' . str_pad((Notice::max('id') + 1),3,'0',STR_PAD_LEFT);
            Notice::create([
            'notice_id' => $noticeID,
            'title' =>trim(($validated['title'])),
            'body' => trim($validated['body']),
            'published_by' => trim($validated['publisher_name']),
            'designation' => trim($validated['designation']),
          ]);
          return redirect()->route('notices.index')->with('success','Notice Created & Published Successfully.');
      } catch(\Exception $e){
    return redirect()->back()->withErrors([
        'wrong' =>  'Notice Create Process Failed!',
    ]);
}
    }
}
