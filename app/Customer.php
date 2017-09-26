<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = [
        'fname',
        'lname',
        'contact',
        'address',
        'user_id',
        'photo'
    ];

}
