<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationCategoryUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('documentation_category_user', function (Blueprint $table) {
            $table->unsignedBigInteger('documentation_category_id');
            $table->foreign('documentation_category_id', 'documentation_category_id_fk_9539758')->references('id')->on('documentation_categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539758')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
