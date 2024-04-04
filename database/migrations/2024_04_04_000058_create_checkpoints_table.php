<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpointsTable extends Migration
{
    public function up()
    {
        Schema::create('checkpoints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_available')->default(0)->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
