<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookingListsTable extends Migration
{
    public function up()
    {
        Schema::table('booking_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9035749')->references('id')->on('users');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9035750')->references('id')->on('clients');
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->foreign('boat_id', 'boat_fk_9035751')->references('id')->on('boats');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_9035752')->references('id')->on('employees');
            $table->unsignedBigInteger('booking_slot_id')->nullable();
            $table->foreign('booking_slot_id', 'booking_slot_fk_9532217')->references('id')->on('booking_slots');
            $table->unsignedBigInteger('financial_document_id')->nullable();
            $table->foreign('financial_document_id', 'financial_document_fk_9584375')->references('id')->on('finalcial_documents');
        });
    }
}
