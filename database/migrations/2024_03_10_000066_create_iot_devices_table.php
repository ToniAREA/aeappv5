<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIotDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('iot_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('device')->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->string('security_token')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('status')->nullable();
            $table->longText('additional_info')->nullable();
            $table->string('source_code_link')->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->string('link')->nullable();
            $table->string('link_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
