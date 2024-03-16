<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<<< HEAD:database/migrations/2024_02_24_000100_add_relationship_fields_to_employee_attendances_table.php
class AddRelationshipFieldsToEmployeeAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('employee_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_9532228')->references('id')->on('employees');
========
class AddRelationshipFieldsToEmployeeHolidaysTable extends Migration
{
    public function up()
    {
        Schema::table('employee_holidays', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_9538911')->references('id')->on('employees');
>>>>>>>> master:database/migrations/2024_03_10_000153_add_relationship_fields_to_employee_holidays_table.php
        });
    }
}
