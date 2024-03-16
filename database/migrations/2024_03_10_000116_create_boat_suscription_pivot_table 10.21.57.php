<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatSuscriptionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_suscription', function (Blueprint $table) {
            $table->unsignedBigInteger('suscription_id');
            $table->foreign('suscription_id', 'suscription_id_fk_9538594')->references('id')->on('suscriptions')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_9538594')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
