<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWlistsTable extends Migration
{
    public function up()
    {
        Schema::create('wlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_type');
            $table->string('boat_namecomplete')->nullable();
            $table->string('description')->nullable();
            $table->float('estimated_hours', 7, 2)->nullable();
            $table->date('deadline')->nullable();
            $table->integer('priority')->nullable();
            $table->string('proforma_link')->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->datetime('last_use')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
