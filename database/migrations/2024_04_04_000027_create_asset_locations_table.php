<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_available')->default(0)->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
