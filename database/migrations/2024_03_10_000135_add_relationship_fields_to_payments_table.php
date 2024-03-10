<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('financial_document_id')->nullable();
            $table->foreign('financial_document_id', 'financial_document_fk_9579364')->references('id')->on('finalcial_documents');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_9579241')->references('id')->on('currencies');
        });
    }
}
