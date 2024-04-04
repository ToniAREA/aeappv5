<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWlogsTable extends Migration
{
    public function up()
    {
        Schema::create('wlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('boat_namecomplete')->nullable();
            $table->date('date');
            $table->longText('description');
            $table->float('hours', 4, 2);
            $table->decimal('hourly_rate', 15, 2)->nullable();
            $table->boolean('travel_cost_included')->default(0)->nullable();
            $table->float('total_travel_cost', 9, 2)->nullable();
            $table->float('total_access_cost', 10, 2)->nullable();
            $table->boolean('wlist_finished')->default(0)->nullable();
            $table->boolean('invoiced_line')->default(0)->nullable();
            $table->longText('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
