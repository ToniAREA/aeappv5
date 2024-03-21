<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechDocsTypeUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('tech_docs_type_user', function (Blueprint $table) {
            $table->unsignedBigInteger('tech_docs_type_id');
            $table->foreign('tech_docs_type_id', 'tech_docs_type_id_fk_9539763')->references('id')->on('tech_docs_types')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539763')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
