<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferedCourses extends Model
{
   protected $table = "offered_courses";
   protected $fillable = [
    'semester','course_code','course_title','course_credit'
   ];

//Belongs from Course.
  public function course()
  {
      return $this->belongsTo(Course::class, 'course_id');
  }
}
