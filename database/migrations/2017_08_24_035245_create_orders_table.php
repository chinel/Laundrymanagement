<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->references('id')->on('customers');
            $table->string('delivery_date')->nullable();
            $table->integer('cloth_id')->references('id')->on('cloths');
            $table->integer('quantity');
            $table->integer('total');
            $table->integer('laundry_id')->references('id')->on('laundries');
            $table->string('status')->default('pending');
            $table->integer('launderer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
