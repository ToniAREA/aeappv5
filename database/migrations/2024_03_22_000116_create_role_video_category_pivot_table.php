<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleVideoCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_video_category', function (Blueprint $table) {
            $table->unsignedBigInteger('video_category_id');
            $table->foreign('video_category_id', 'video_category_id_fk_9539904')->references('id')->on('video_categories')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539904')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
