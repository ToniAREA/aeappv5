<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(0)->nullable();
            $table->string('provider_name');
            $table->string('policy_number')->nullable();
            $table->string('period')->nullable();
            $table->decimal('period_cost', 15, 2)->nullable();
            $table->string('coverage_type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->string('link_a')->nullable();
            $table->string('link_a_description')->nullable();
            $table->string('link_b')->nullable();
            $table->string('link_b_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
