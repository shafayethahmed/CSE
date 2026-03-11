<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyCourse extends Model
{
    protected $table = "faculty_course_taught";
    protected $fillable = [
        'course_id',
        'faculty_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id');
    }
}
