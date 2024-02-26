<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientsReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('clients_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9532878')->references('id')->on('clients');
            $table->unsignedBigInteger('proforma_id')->nullable();
            $table->foreign('proforma_id', 'proforma_fk_9532879')->references('id')->on('proformas');
        });
    }
}
