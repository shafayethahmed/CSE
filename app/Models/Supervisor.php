<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{      
      protected $table = "batch_supervisor";
      protected $fillable = [
        'faculty_id',
        'semester'
      ];
        public function faculty()
        {
            return $this->belongsTo(Faculty::class);
        }
}
