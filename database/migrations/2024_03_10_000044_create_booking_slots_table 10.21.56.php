<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingSlotsTable extends Migration
{
    public function up()
    {
        Schema::create('booking_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('star_time');
            $table->datetime('end_time');
            $table->float('rate_multiplier', 6, 2);
            $table->boolean('show_online')->default(0)->nullable();
            $table->boolean('booked')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
