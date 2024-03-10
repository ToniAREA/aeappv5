<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideoCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_video_category', function (Blueprint $table) {
            $table->unsignedBigInteger('video_category_id');
            $table->foreign('video_category_id', 'video_category_id_fk_9539905')->references('id')->on('video_categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539905')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
