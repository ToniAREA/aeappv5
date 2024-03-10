<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetCategoryRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('asset_category_role', function (Blueprint $table) {
            $table->unsignedBigInteger('asset_category_id');
            $table->foreign('asset_category_id', 'asset_category_id_fk_9539734')->references('id')->on('asset_categories')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539734')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
