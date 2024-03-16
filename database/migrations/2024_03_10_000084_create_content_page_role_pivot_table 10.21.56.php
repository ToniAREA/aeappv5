<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPageRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_page_role', function (Blueprint $table) {
            $table->unsignedBigInteger('content_page_id');
            $table->foreign('content_page_id', 'content_page_id_fk_9539759')->references('id')->on('content_pages')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9539759')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
