<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWlistsTable extends Migration
{
    public function up()
    {
        Schema::table('wlists', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_8901291')->references('id')->on('clients');
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->foreign('boat_id', 'boat_fk_7894053')->references('id')->on('boats');
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->foreign('from_user_id', 'from_user_fk_8952055')->references('id')->on('users');
            $table->unsignedBigInteger('for_employee_id')->nullable();
            $table->foreign('for_employee_id', 'for_employee_fk_9531272')->references('id')->on('employees');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9531903')->references('id')->on('wlist_statuses');
        });
    }
}
