<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('video_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_online')->default(0)->nullable();
            $table->string('subject')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
