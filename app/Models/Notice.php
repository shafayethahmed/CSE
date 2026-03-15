<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{     
       protected $table = "notices";
        protected $fillable = [
            'notice_id',
            'title',
            'body',
            'published_by',
            'designation',
            'created_at',
        ];
        
}
