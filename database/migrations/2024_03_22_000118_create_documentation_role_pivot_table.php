<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('documentation_role', function (Blueprint $table) {
            $table->unsignedBigInteger('documentation_id');
            $table->foreign('documentation_id', 'documentation_id_fk_9539738')->references('id')->on('documentations')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539738')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
