<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_9035862')->references('id')->on('employees');
        });
    }
}
