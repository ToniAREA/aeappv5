<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqCategoryRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('faq_category_role', function (Blueprint $table) {
            $table->unsignedBigInteger('faq_category_id');
            $table->foreign('faq_category_id', 'faq_category_id_fk_9539824')->references('id')->on('faq_categories')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539824')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
