<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confrim_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name');
            $table->string('phone');
            $table->string('location');
            //realation ship
            $table->integer('order_id');
            $table->integer('user_id');

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
        Schema::dropIfExists('confrim_orders');
    }
};
