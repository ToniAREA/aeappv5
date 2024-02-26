<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeeRatingsTable extends Migration
{
    public function up()
    {
        Schema::table('employee_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_9538967')->references('id')->on('employees');
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->foreign('from_user_id', 'from_user_fk_9538968')->references('id')->on('users');
            $table->unsignedBigInteger('from_client_id')->nullable();
            $table->foreign('from_client_id', 'from_client_fk_9538969')->references('id')->on('clients');
            $table->unsignedBigInteger('for_wlist_id')->nullable();
            $table->foreign('for_wlist_id', 'for_wlist_fk_9538970')->references('id')->on('wlists');
            $table->unsignedBigInteger('for_wlog_id')->nullable();
            $table->foreign('for_wlog_id', 'for_wlog_fk_9538971')->references('id')->on('wlogs');
        });
    }
}
