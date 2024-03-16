<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactContactInsurancePivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_contact_insurance', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_id');
            $table->foreign('insurance_id', 'insurance_id_fk_9538504')->references('id')->on('insurances')->onDelete('cascade');
            $table->unsignedBigInteger('contact_contact_id');
            $table->foreign('contact_contact_id', 'contact_contact_id_fk_9538504')->references('id')->on('contact_contacts')->onDelete('cascade');
        });
    }
}
