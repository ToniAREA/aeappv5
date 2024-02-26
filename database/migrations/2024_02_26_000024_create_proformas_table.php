<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformasTable extends Migration
{
    public function up()
    {
        Schema::create('proformas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('proforma_number')->unique();
            $table->boolean('closed_and_protected')->default(0)->nullable();
            $table->string('invoice_link')->nullable();
            $table->date('date')->nullable();
            $table->string('description')->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->string('currency')->nullable();
            $table->boolean('sent')->default(0)->nullable();
            $table->boolean('paid')->default(0)->nullable();
            $table->integer('claims')->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
