<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMlogsTable extends Migration
{
    public function up()
    {
        Schema::table('mlogs', function (Blueprint $table) {
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->foreign('boat_id', 'boat_fk_9531905')->references('id')->on('boats');
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_9531907')->references('id')->on('wlists');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_9531909')->references('id')->on('users');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9531911')->references('id')->on('products');
            $table->unsignedBigInteger('proforma_number_id')->nullable();
            $table->foreign('proforma_number_id', 'proforma_number_fk_9531916')->references('id')->on('proformas');
        });
    }
}
