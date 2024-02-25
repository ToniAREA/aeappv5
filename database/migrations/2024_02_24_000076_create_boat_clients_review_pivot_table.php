<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatClientsReviewPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_clients_review', function (Blueprint $table) {
            $table->unsignedBigInteger('clients_review_id');
            $table->foreign('clients_review_id', 'clients_review_id_fk_9532877')->references('id')->on('clients_reviews')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_9532877')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
