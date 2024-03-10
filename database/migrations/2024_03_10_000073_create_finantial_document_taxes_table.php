<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinantialDocumentTaxesTable extends Migration
{
    public function up()
    {
        Schema::create('finantial_document_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tax_type');
            $table->float('tax_rate', 5, 2)->nullable();
            $table->decimal('tax_amount', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
