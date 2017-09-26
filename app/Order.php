<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
     'customer_id',
      'cloth_id',
      'quantity',
       'total',
        'laundry_id'
    ];


    public function quantity($id){

        $order =  Order::where('customer_id',$id)->get();
        return $order->pluck('quantity')->toArray();

    }


    public function total($id){

        $order =  Order::where('customer_id',$id)->get();
        return $order->pluck('total')->toArray();
    }


}
