<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpointCheckpointsGroupPivotTable extends Migration
{
    public function up()
    {
        Schema::create('checkpoint_checkpoints_group', function (Blueprint $table) {
            $table->unsignedBigInteger('checkpoint_id');
            $table->foreign('checkpoint_id', 'checkpoint_id_fk_9552070')->references('id')->on('checkpoints')->onDelete('cascade');
            $table->unsignedBigInteger('checkpoints_group_id');
            $table->foreign('checkpoints_group_id', 'checkpoints_group_id_fk_9552070')->references('id')->on('checkpoints_groups')->onDelete('cascade');
        });
    }
}
