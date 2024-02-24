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
            $table->decimal('hourly_rate', 15, 2)->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->string('status')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
