<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesSkillsTable extends Migration
{
    public function up()
    {
        Schema::create('employees_skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level')->nullable();
            $table->string('description')->nullable();
            $table->boolean('verified')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
