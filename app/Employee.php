<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'contact',
        'position',
        'gender',
        'birthdate',
        'address',
        'user_id',
        'photo'
    ];
}
