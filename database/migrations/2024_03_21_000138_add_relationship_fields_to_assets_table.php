<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssetsTable extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_8848165')->references('id')->on('asset_categories');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_8848169')->references('id')->on('asset_statuses');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_8848170')->references('id')->on('asset_locations');
            $table->unsignedBigInteger('actual_holder_id')->nullable();
            $table->foreign('actual_holder_id', 'actual_holder_fk_9531518')->references('id')->on('users');
        });
    }
}
