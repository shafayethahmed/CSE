<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Faculty extends Authenticatable
{
    use Notifiable;

    protected $table = 'faculties';

    // Guard name (for multiple authentication)
    protected $guard = 'faculty';

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
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Automatically hash password when saving
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

}