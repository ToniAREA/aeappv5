<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWlogsTable extends Migration
{
    public function up()
    {
        Schema::table('wlogs', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_8342547')->references('id')->on('wlists');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_8238948')->references('id')->on('users');
            $table->unsignedBigInteger('marina_id')->nullable();
            $table->foreign('marina_id', 'marina_fk_8239254')->references('id')->on('marinas');
            $table->unsignedBigInteger('financial_document_id')->nullable();
            $table->foreign('financial_document_id', 'financial_document_fk_9582915')->references('id')->on('finalcial_documents');
        });
    }
}
