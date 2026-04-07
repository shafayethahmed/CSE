<?php

namespace App\Http\Controllers\Faculty;
use Illuminate\Routing\Controller; 

use Illuminate\Http\Request;

class FacultyPasswordController extends Controller
{
    public function index(){
        return view('auth-faculty.change-password');
    }
}
