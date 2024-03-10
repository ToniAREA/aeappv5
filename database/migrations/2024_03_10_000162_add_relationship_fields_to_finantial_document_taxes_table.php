<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFinantialDocumentTaxesTable extends Migration
{
    public function up()
    {
        Schema::table('finantial_document_taxes', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id', 'item_fk_9579337')->references('id')->on('financial_document_items');
        });
    }
}
