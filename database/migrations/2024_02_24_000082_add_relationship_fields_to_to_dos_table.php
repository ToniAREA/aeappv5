<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToToDosTable extends Migration
{
    public function up()
    {
        Schema::table('to_dos', function (Blueprint $table) {
            $table->unsignedBigInteger('for_employee_id')->nullable();
            $table->foreign('for_employee_id', 'for_employee_fk_9531228')->references('id')->on('employees');
        });
    }
}
