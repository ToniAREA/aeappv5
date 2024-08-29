<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideoTutorialPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_video_tutorial', function (Blueprint $table) {
            $table->unsignedBigInteger('video_tutorial_id');
            $table->foreign('video_tutorial_id', 'video_tutorial_id_fk_9539789')->references('id')->on('video_tutorials')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539789')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
