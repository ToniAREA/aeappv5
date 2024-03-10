<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoryVideoTutorialPivotTable extends Migration
{
    public function up()
    {
        Schema::create('video_category_video_tutorial', function (Blueprint $table) {
            $table->unsignedBigInteger('video_tutorial_id');
            $table->foreign('video_tutorial_id', 'video_tutorial_id_fk_9532935')->references('id')->on('video_tutorials')->onDelete('cascade');
            $table->unsignedBigInteger('video_category_id');
            $table->foreign('video_category_id', 'video_category_id_fk_9532935')->references('id')->on('video_categories')->onDelete('cascade');
        });
    }
}
