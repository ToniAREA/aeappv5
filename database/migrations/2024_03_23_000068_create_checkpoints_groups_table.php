<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpointsGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('checkpoints_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
