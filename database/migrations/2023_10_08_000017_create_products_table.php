<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_manu')->nullable();
            $table->string('ref_provider')->nullable();
            $table->string('model')->nullable();
            $table->string('name')->nullable();
            $table->string('product_slug')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->float('pro_discount', 5, 2)->nullable();
            $table->string('stock')->nullable();
            $table->integer('local_stock')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
