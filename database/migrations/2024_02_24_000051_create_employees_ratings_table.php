<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('employees_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rating')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('show_online')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
