<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('has_active_vip_plan')->default(0)->nullable();
            $table->boolean('defaulter')->default(0)->nullable();
            $table->string('ref')->nullable();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('vat')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('link_a')->nullable();
            $table->string('link_a_description')->nullable();
            $table->string('link_b')->nullable();
            $table->string('link_b_description')->nullable();
            $table->datetime('last_use')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
