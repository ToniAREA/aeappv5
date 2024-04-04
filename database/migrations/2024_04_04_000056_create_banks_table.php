<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(0)->nullable();
            $table->string('name');
            $table->string('branch')->nullable();
            $table->string('account_number');
            $table->string('account_name')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('address')->nullable();
            $table->date('join_date')->nullable();
            $table->decimal('current_balance', 15, 2)->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->string('link_a')->nullable();
            $table->string('link_a_description')->nullable();
            $table->string('link_b')->nullable();
            $table->string('link_b_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
