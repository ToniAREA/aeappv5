<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeesRatingsTable extends Migration
{
    public function up()
    {
        Schema::table('employees_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_9532639')->references('id')->on('employees');
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->foreign('from_user_id', 'from_user_fk_9532834')->references('id')->on('users');
            $table->unsignedBigInteger('from_client_id')->nullable();
            $table->foreign('from_client_id', 'from_client_fk_9532835')->references('id')->on('clients');
            $table->unsignedBigInteger('for_wlist_id')->nullable();
            $table->foreign('for_wlist_id', 'for_wlist_fk_9532836')->references('id')->on('wlists');
            $table->unsignedBigInteger('for_wlog_id')->nullable();
            $table->foreign('for_wlog_id', 'for_wlog_fk_9532837')->references('id')->on('wlogs');
        });
    }
}
