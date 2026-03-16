<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request){
        $query = Notice::query();
        if($request->noticesearch){
          $query->where(function ($q) use ($request){
            $q->where('title','like','%'.$request->noticesearch.'%')
            ->orWhere('notice_id','like','%'.$request->noticesearch.'%');
          });
        }
         $notices = $query->paginate(10)->withQueryString();
        //Ajax Reuqest baack: 
        if($request->ajax()){
            return view('notices.partials.table',compact('notices'))->render();
        }
        return view('notices.index',compact('notices'));
    }
    public function create(){
        return view('notices.create');
    }

    public function show(Notice $notice){
        return view('notices.show',compact('notice'));
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
        'wrong' =>  $e->getMessage(),
    ]);
  }
    }

 //Edit function:
 public function edit(Notice $notice){
    //return Individul notice Information: 
        return view('notices.edit',compact('notice'));
 }

 //Update Function for Notice Update:
   public function update(Request $request, Notice $notice)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'body' => 'required|string',
        'publisher_name' => 'required|string',
        'designation' => 'required|string',
    ]);

    try{

        $notice->update([
            'title' => trim($validated['title']),
            'body' => trim($validated['body']),
            'published_by' => trim($validated['publisher_name']),
            'designation' => trim($validated['designation']),
        ]);

        return redirect()
                ->route('notices.index')
                ->with('success','Notice Updated Successfully.');

    }catch(\Exception $e){

        return redirect()
                ->back()
                ->withErrors(['wrong' => $e->getMessage()])
                ->withInput();
    }
}

public function destroy(Notice $notice)
{
    try{

        $notice->delete();

        return redirect()
                ->route('notices.index')
                ->with('success','Notice Deleted Successfully.');

    }catch(\Exception $e){

        return redirect()
                ->back()
                ->withErrors(['wrong' => 'Something Error!']);
    }
}
}
