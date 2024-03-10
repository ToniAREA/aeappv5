<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPageUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_page_user', function (Blueprint $table) {
            $table->unsignedBigInteger('content_page_id');
            $table->foreign('content_page_id', 'content_page_id_fk_9539760')->references('id')->on('content_pages')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539760')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
