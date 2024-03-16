<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMlogsTable extends Migration
{
    public function up()
    {
        Schema::create('mlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('boat_namecomplete')->nullable();
            $table->date('date');
            $table->string('item')->nullable();
            $table->longText('description')->nullable();
            $table->float('units', 10, 2)->nullable();
            $table->decimal('price_unit', 15, 2)->nullable();
            $table->boolean('invoiced_line')->default(0)->nullable();
            $table->string('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
