<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('documentation_user', function (Blueprint $table) {
            $table->unsignedBigInteger('documentation_id');
            $table->foreign('documentation_id', 'documentation_id_fk_9539739')->references('id')->on('documentations')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539739')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
