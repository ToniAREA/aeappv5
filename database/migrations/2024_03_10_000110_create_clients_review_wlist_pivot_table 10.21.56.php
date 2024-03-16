<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsReviewWlistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('clients_review_wlist', function (Blueprint $table) {
            $table->unsignedBigInteger('clients_review_id');
            $table->foreign('clients_review_id', 'clients_review_id_fk_9532880')->references('id')->on('clients_reviews')->onDelete('cascade');
            $table->unsignedBigInteger('wlist_id');
            $table->foreign('wlist_id', 'wlist_id_fk_9532880')->references('id')->on('wlists')->onDelete('cascade');
        });
    }
}
