<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('faq_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('show_online')->default(0)->nullable();
            $table->longText('question')->nullable();
            $table->longText('answer')->nullable();
            $table->integer('view_count')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
