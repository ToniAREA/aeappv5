<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('suscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(0)->nullable();
            $table->string('plan_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->float('hourly_rate_discount', 5, 2)->nullable();
            $table->float('material_discount', 5, 2)->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
