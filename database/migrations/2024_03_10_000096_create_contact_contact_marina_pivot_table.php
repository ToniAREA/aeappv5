<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactContactMarinaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_contact_marina', function (Blueprint $table) {
            $table->unsignedBigInteger('marina_id');
            $table->foreign('marina_id', 'marina_id_fk_9551878')->references('id')->on('marinas')->onDelete('cascade');
            $table->unsignedBigInteger('contact_contact_id');
            $table->foreign('contact_contact_id', 'contact_contact_id_fk_9551878')->references('id')->on('contact_contacts')->onDelete('cascade');
        });
    }
}
