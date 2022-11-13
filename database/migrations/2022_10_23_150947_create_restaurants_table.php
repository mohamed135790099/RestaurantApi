<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('Longitude')->unique();
            $table->double('Latitude')->unique();
            $table->string('rate');
            $table->string('name');
            $table->string('title');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->text('description');
            $table->string('image')->nullable();


            //relationship
            $table->integer('menu_id')->unique();
            $table->integer('booking_id')->nullable();
            $table->integer('order_id')->nullable();


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
        Schema::dropIfExists('restaurants');
    }
};
