<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqQuestionRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('faq_question_role', function (Blueprint $table) {
            $table->unsignedBigInteger('faq_question_id');
            $table->foreign('faq_question_id', 'faq_question_id_fk_9539857')->references('id')->on('faq_questions')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539857')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
