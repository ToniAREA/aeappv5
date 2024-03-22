<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentEmployeePivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_9552051')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_9552051')->references('id')->on('employees')->onDelete('cascade');
        });
    }
}
