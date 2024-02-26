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
            $table->boolean('show_online')->default(0)->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('product_price', 15, 2)->nullable();
            $table->float('purchase_discount', 5, 2)->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->boolean('has_stock')->default(0)->nullable();
            $table->integer('local_stock')->nullable();
            $table->string('link_a')->nullable();
            $table->string('link_a_description')->nullable();
            $table->string('link_b')->nullable();
            $table->string('link_b_description')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_meta_description')->nullable();
            $table->string('seo_slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
