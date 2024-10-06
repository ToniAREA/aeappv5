<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOauthColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('apple_id')->nullable()->unique();
            $table->string('facebook_id')->nullable()->unique();
            $table->string('avatar')->nullable(); // Para guardar la foto de perfil, si quieres
            $table->string('nickname')->nullable(); // Para guardar el nickname, si es aplicable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'apple_id', 'facebook_id', 'avatar', 'nickname']);
        });
    }
}
