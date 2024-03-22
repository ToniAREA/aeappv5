<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeHolidaysTable extends Migration
{
    public function up()
    {
        Schema::create('employee_holidays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days_taken');
            $table->boolean('is_completed')->default(0)->nullable();
            $table->string('type')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
