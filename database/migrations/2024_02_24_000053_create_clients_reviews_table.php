<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('clients_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('rating', 3, 1)->nullable();
            $table->boolean('shown_online')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
