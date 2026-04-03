<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = "courses";
    protected $fillable = [
            'course_code', 
            'course_title',         
            'course_credit',
            'course_type',

    ];


   public function faculties()
{
    return $this->belongsToMany(
        Faculty::class,
        'faculty_course_taught',   // pivot table name
        'course_id',               // foreign key of this model
        'faculty_id'               // foreign key of related model
    );
}

public function offeredCourses()
{
    return $this->hasMany(OfferedCourses::class, 'course_id');
}

}
