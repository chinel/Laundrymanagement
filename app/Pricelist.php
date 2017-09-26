<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    protected $fillable = [
      'laundry_id',
        'cloth_id',
        'price'
    ];
}
