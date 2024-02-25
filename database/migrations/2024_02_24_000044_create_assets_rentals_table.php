<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsRentalsTable extends Migration
{
    public function up()
    {
        Schema::create('assets_rentals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date');
            $table->string('end_date');
            $table->string('rental_details')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('invoiced')->default(0)->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->string('rental_unit');
            $table->integer('rental_quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
