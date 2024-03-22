<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFinancialDocumentItemsTable extends Migration
{
    public function up()
    {
        Schema::table('financial_document_items', function (Blueprint $table) {
            $table->unsignedBigInteger('financial_document_id')->nullable();
            $table->foreign('financial_document_id', 'financial_document_fk_9579286')->references('id')->on('finalcial_documents');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9579287')->references('id')->on('products');
        });
    }
}
