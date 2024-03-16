<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPagesTable extends Migration
{
    public function up()
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->boolean('show_online')->default(0)->nullable();
            $table->string('slug')->nullable();
            $table->longText('page_text')->nullable();
            $table->longText('excerpt')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_meta_description')->nullable();
            $table->string('seo_slug')->nullable();
            $table->string('link_a')->nullable();
            $table->string('link_a_description')->nullable();
            $table->boolean('show_online_link_a')->default(0)->nullable();
            $table->string('link_b')->nullable();
            $table->string('link_b_description')->nullable();
            $table->boolean('show_online_link_b')->default(0)->nullable();
            $table->integer('view_count')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
