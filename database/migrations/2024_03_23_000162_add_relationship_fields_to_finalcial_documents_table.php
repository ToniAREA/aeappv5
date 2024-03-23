<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFinalcialDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('finalcial_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9579273')->references('id')->on('clients');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_9579276')->references('id')->on('currencies');
        });
    }
}
