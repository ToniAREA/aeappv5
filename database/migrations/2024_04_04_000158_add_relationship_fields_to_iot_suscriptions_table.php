<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIotSuscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('iot_suscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9543692')->references('id')->on('users');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9543695')->references('id')->on('clients');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id', 'plan_fk_9543697')->references('id')->on('iot_plans');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id', 'device_fk_9543748')->references('id')->on('iot_devices');
            $table->unsignedBigInteger('financial_document_id')->nullable();
            $table->foreign('financial_document_id', 'financial_document_fk_9584378')->references('id')->on('finalcial_documents');
        });
    }
}
