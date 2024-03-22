<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatIotSuscriptionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_iot_suscription', function (Blueprint $table) {
            $table->unsignedBigInteger('iot_suscription_id');
            $table->foreign('iot_suscription_id', 'iot_suscription_id_fk_9543696')->references('id')->on('iot_suscriptions')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_9543696')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
