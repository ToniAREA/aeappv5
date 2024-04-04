<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(0)->nullable();
            $table->string('name');
            $table->string('provider_url')->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->string('status')->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
