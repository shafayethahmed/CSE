<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Faculty extends Model
{
      protected $table = 'faculties';

    protected $fillable = [
        'faculty_id',
        'name',
        'email',
        'designation',
        'credit_limit',
        'bachelor_degree',
        'bachelor_university',
        'bachelor_cgpa',
        'master_degree',
        'master_university',
        'master_cgpa',
        'faculty_status',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
   

   
}
