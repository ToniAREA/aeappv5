<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatWaitingListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_waiting_list', function (Blueprint $table) {
            $table->unsignedBigInteger('waiting_list_id');
            $table->foreign('waiting_list_id', 'waiting_list_id_fk_9619295')->references('id')->on('waiting_lists')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_9619295')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
