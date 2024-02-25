<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductProviderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_provider', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_9531395')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id', 'provider_id_fk_9531395')->references('id')->on('providers')->onDelete('cascade');
        });
    }
}
