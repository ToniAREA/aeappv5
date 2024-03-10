<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMaintenanceSuscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('maintenance_suscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9538704')->references('id')->on('users');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9538707')->references('id')->on('clients');
            $table->unsignedBigInteger('care_plan_id')->nullable();
            $table->foreign('care_plan_id', 'care_plan_fk_9538709')->references('id')->on('care_plans');
            $table->unsignedBigInteger('financial_document_id')->nullable();
            $table->foreign('financial_document_id', 'financial_document_fk_9584377')->references('id')->on('finalcial_documents');
        });
    }
}
