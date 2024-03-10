<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentCategoryRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_category_role', function (Blueprint $table) {
            $table->unsignedBigInteger('content_category_id');
            $table->foreign('content_category_id', 'content_category_id_fk_9539752')->references('id')->on('content_categories')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539752')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
