<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTechnicalDocumentationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_technical_documentation', function (Blueprint $table) {
            $table->unsignedBigInteger('technical_documentation_id');
            $table->foreign('technical_documentation_id', 'technical_documentation_id_fk_9539755')->references('id')->on('technical_documentations')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539755')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
