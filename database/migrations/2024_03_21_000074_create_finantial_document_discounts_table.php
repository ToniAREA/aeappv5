<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinantialDocumentDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('finantial_document_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->float('discount_rate', 5, 2)->nullable();
            $table->decimal('discount_amount', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
