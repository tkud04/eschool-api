<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'token', 'class_id', 'school_code', 'status'
    ];
    
}
