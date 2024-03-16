<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalDocumentationUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('technical_documentation_user', function (Blueprint $table) {
            $table->unsignedBigInteger('technical_documentation_id');
            $table->foreign('technical_documentation_id', 'technical_documentation_id_fk_9539756')->references('id')->on('technical_documentations')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539756')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
