<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitingListsTable extends Migration
{
    public function up()
    {
        Schema::create('waiting_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('waiting_for')->nullable();
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
