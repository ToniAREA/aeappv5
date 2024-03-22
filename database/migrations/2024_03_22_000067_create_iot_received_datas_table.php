<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIotReceivedDatasTable extends Migration
{
    public function up()
    {
        Schema::create('iot_received_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('security_token')->nullable();
            $table->longText('received_data')->nullable();
            $table->float('service_voltage', 4, 2)->nullable();
            $table->float('engine_1_voltage', 4, 2)->nullable();
            $table->float('engine_2_voltage', 4, 2)->nullable();
            $table->boolean('bilge_alarm')->default(0)->nullable();
            $table->boolean('shore_alarm')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
