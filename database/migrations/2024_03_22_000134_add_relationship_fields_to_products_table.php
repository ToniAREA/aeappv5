<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id', 'brand_fk_8239117')->references('id')->on('brands');
            $table->unsignedBigInteger('product_location_id')->nullable();
            $table->foreign('product_location_id', 'product_location_fk_9035747')->references('id')->on('asset_locations');
        });
    }
}