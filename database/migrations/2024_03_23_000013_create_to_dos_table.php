<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToDosTable extends Migration
{
    public function up()
    {
        Schema::create('to_dos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task')->nullable();
            $table->longText('notes')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('priority')->nullable();
            $table->boolean('is_repetitive')->default(0)->nullable();
            $table->integer('repeat_interval_value')->nullable();
            $table->string('repeat_interval_unit')->nullable();
            $table->string('internal_notes')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
