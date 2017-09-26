<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'customer_id',
         'sales_date',
         'paymentType',
         'amount'
    ];
}
