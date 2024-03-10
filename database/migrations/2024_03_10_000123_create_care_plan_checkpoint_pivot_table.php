<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarePlanCheckpointPivotTable extends Migration
{
    public function up()
    {
        Schema::create('care_plan_checkpoint', function (Blueprint $table) {
            $table->unsignedBigInteger('care_plan_id');
            $table->foreign('care_plan_id', 'care_plan_id_fk_9539030')->references('id')->on('care_plans')->onDelete('cascade');
            $table->unsignedBigInteger('checkpoint_id');
            $table->foreign('checkpoint_id', 'checkpoint_id_fk_9539030')->references('id')->on('checkpoints')->onDelete('cascade');
        });
    }
}
