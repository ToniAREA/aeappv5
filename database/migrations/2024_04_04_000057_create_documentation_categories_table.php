<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('documentation_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_online')->default(0)->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
