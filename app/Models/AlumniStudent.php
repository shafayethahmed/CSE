<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniStudent extends Model
{
    protected $table = "alumni_students";
  protected $fillable = [
    'academicId',
    'name',
    'email',
    'mobile',
    'session',
   'admissionYear',
    'passedyear',
    'dob',
    'address'
  ];
}
