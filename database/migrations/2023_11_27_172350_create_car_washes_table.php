<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_washes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('phonenumber');
            $table->enum('washtype', array('All' , 'inside' ,'body'));
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_washes');
    }
};
