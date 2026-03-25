<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'academicId',
        'email',
        'name',
        'session',
        'admissionYear',
        'semester',
        'mobile',
        'dob',
        'address',
    ];
}
