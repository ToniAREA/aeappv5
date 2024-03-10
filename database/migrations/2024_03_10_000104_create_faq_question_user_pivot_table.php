<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqQuestionUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('faq_question_user', function (Blueprint $table) {
            $table->unsignedBigInteger('faq_question_id');
            $table->foreign('faq_question_id', 'faq_question_id_fk_9539858')->references('id')->on('faq_questions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9539858')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
