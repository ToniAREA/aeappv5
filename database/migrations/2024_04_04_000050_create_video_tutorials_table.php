<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTutorialsTable extends Migration
{
    public function up()
    {
        Schema::create('video_tutorials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_online')->default(0)->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_meta_description')->nullable();
            $table->string('seo_slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
