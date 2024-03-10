<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIotReceivedDatasTable extends Migration
{
    public function up()
    {
        Schema::table('iot_received_datas', function (Blueprint $table) {
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id', 'device_fk_9554392')->references('id')->on('iot_devices');
        });
    }
}
