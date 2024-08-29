<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMarinasTable extends Migration
{
    public function up()
    {
        Schema::table('marinas', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_docs_id')->nullable();
            $table->foreign('contact_docs_id', 'contact_docs_fk_9538383')->references('id')->on('contact_contacts');
        });
    }
}
