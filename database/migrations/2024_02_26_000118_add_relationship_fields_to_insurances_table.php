<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInsurancesTable extends Migration
{
    public function up()
    {
        Schema::table('insurances', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_9538497')->references('id')->on('contact_companies');
        });
    }
}
