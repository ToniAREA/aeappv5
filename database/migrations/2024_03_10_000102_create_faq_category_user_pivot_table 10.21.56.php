<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqCategoryUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('faq_category_user', function (Blueprint $table) {
            $table->unsignedBigInteger('faq_category_id');
            $table->foreign('faq_category_id', 'faq_category_id_fk_9539825')->references('id')->on('faq_categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539825')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
