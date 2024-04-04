<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(0)->nullable();
            $table->string('id_employee')->nullable();
            $table->string('namecomplete')->nullable();
            $table->string('status')->nullable();
            $table->date('contract_starts')->nullable();
            $table->date('contract_ends')->nullable();
            $table->string('category')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->string('link')->nullable();
            $table->string('link_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
