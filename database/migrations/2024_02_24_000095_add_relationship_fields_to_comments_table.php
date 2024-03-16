<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_8952811')->references('id')->on('wlists');
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->foreign('from_user_id', 'from_user_fk_8952812')->references('id')->on('users');
        });
    }
}
