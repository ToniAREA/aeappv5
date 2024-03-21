<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatsTable extends Migration
{
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref')->nullable();
            $table->string('boat_type')->nullable();
            $table->string('name');
            $table->string('imo')->nullable();
            $table->string('mmsi')->nullable();
            $table->string('sat_phone')->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->datetime('last_use')->nullable();
            $table->longText('settings_data')->nullable();
            $table->string('public_ip')->nullable();
            $table->string('coordinates')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
