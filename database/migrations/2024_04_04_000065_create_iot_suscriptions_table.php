<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIotSuscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('iot_suscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(0)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('hourly_rate', 15, 2)->nullable();
            $table->float('hourly_rate_discount', 5, 2)->nullable();
            $table->float('material_discount', 5, 2)->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->date('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
