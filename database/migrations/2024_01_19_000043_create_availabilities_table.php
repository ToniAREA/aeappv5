<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('star_time');
            $table->datetime('end_time');
            $table->float('rate_multiplier', 6, 2);
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
