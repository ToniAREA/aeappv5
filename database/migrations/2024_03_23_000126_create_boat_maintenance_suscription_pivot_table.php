<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatMaintenanceSuscriptionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_maintenance_suscription', function (Blueprint $table) {
            $table->unsignedBigInteger('maintenance_suscription_id');
            $table->foreign('maintenance_suscription_id', 'maintenance_suscription_id_fk_9538708')->references('id')->on('maintenance_suscriptions')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_9538708')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
