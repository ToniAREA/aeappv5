<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTechnicalDocumentationsTable extends Migration
{
    public function up()
    {
        Schema::table('technical_documentations', function (Blueprint $table) {
            $table->unsignedBigInteger('doc_type_id')->nullable();
            $table->foreign('doc_type_id', 'doc_type_fk_9532391')->references('id')->on('tech_docs_types');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id', 'brand_fk_9532392')->references('id')->on('brands');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9532393')->references('id')->on('products');
        });
    }
}
