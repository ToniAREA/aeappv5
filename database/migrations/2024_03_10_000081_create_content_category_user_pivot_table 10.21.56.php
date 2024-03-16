<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentCategoryUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_category_user', function (Blueprint $table) {
            $table->unsignedBigInteger('content_category_id');
            $table->foreign('content_category_id', 'content_category_id_fk_9539753')->references('id')->on('content_categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539753')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
