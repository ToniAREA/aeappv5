<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('comment_user', function (Blueprint $table) {
            $table->unsignedBigInteger('comment_id');
            $table->foreign('comment_id', 'comment_id_fk_9622541')->references('id')->on('comments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9622541')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
