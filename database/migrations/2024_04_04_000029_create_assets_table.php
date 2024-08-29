<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_available')->default(0)->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->string('data_1')->nullable();
            $table->string('data_1_description')->nullable();
            $table->string('data_2')->nullable();
            $table->string('data_2_description')->nullable();
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
