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
            $table->string('plan_name');
            $table->string('short_description');
            $table->longText('description')->nullable();
            $table->boolean('show_online')->default(0)->nullable();
            $table->string('period');
            $table->decimal('period_price', 15, 2);
            $table->decimal('hourly_rate', 15, 2)->nullable();
            $table->float('hourly_rate_discount', 5, 2)->nullable();
            $table->float('material_discount', 5, 2)->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_meta_description')->nullable();
            $table->string('seo_slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
