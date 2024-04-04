<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTechDocsTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_tech_docs_type', function (Blueprint $table) {
            $table->unsignedBigInteger('tech_docs_type_id');
            $table->foreign('tech_docs_type_id', 'tech_docs_type_id_fk_9539762')->references('id')->on('tech_docs_types')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539762')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
