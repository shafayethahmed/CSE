<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
     //user index
    public function index(Request $request)
{
    $users = User::query();

    if($request->search){
        $users->where(function($q) use ($request){
            $q->where('name','like','%'.$request->search.'%')
              ->orWhere('email','like','%'.$request->search.'%')
              ->orWhere('mobile','like','%'.$request->search.'%');
        });
    }

    if($request->role){
        $users->where('role',$request->role);
    }

$users = $users->latest()->paginate(10)->withQueryString();

    if($request->ajax()){
        return view('users.partials.table', compact('users'))->render();
    }

    return view('users.index', compact('users'));
}
     //User Create Form: 
     public function create(){
       return view('users.create');
     }

    //Storing the Student Information: 
    public function store(Request $request){
        //Process Student data for insert.
       $validated = $request->validate([
            'name'   => 'required|string',
            'email'  => 'required|email|unique:users,email',
            'mobile' => 'required|regex:/^01[3-9]\d{8}$/|unique:users,mobile',
            'role'   => 'required|in:staff,user,department-head,super-admin',
        ]);

        // Validated Data insertion to the Table: 
        try{
             User::create([
           'name' => $validated['name'],
           'email' => $validated['email'],
           'mobile' => $validated['mobile'],
           'role' => $validated['role'],
           'password' => Hash::make('12345678'),
        ]);
        //Return Success to the index.
          return redirect()->route('users.index')->with('success','User Created Successfully');
        } catch(\Exception $e){
             return redirect()->back()->with('error', 'User creation failed!');
        }
    } 

    //Edit form display for User:
    public function edit(User $user){
        return view('users.edit',compact('user')); //Need to assign the Student Edit Form.
    }
     
    // Sotre User Data Update:
   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'role' => $request->role,
        'status' => $request->status,
    ]);

    return redirect()->route('users.index')->with('success', 'User Updated Successfully!');
}

//User Delete :
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

}
