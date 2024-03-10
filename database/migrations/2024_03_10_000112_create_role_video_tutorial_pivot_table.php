<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleVideoTutorialPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_video_tutorial', function (Blueprint $table) {
            $table->unsignedBigInteger('video_tutorial_id');
            $table->foreign('video_tutorial_id', 'video_tutorial_id_fk_9539788')->references('id')->on('video_tutorials')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539788')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
