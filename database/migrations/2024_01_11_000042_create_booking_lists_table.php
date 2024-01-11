<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingListsTable extends Migration
{
    public function up()
    {
        Schema::create('booking_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('hours')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->float('hour_rate', 8, 2);
            $table->float('total_price', 10, 2);
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
