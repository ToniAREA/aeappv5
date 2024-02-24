<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plan_name')->nullable();
            $table->boolean('show_online')->default(0)->nullable();
            $table->string('description')->nullable();
            $table->integer('duration_months')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
