<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_category_role', function (Blueprint $table) {
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_id_fk_9539725')->references('id')->on('product_categories')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539725')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
