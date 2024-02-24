<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSuscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('suscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9533079')->references('id')->on('users');
            $table->unsignedBigInteger('proforma_id')->nullable();
            $table->foreign('proforma_id', 'proforma_fk_9533081')->references('id')->on('proformas');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9533082')->references('id')->on('clients');
        });
    }
}
