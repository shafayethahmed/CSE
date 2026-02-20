<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(){
        return view('notices.index');
    }
    public function create(){
        return view('notices.create');
    }
}
