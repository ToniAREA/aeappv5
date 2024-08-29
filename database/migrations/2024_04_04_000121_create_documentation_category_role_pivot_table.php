<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationCategoryRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('documentation_category_role', function (Blueprint $table) {
            $table->unsignedBigInteger('documentation_category_id');
            $table->foreign('documentation_category_id', 'documentation_category_id_fk_9539757')->references('id')->on('documentation_categories')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539757')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
