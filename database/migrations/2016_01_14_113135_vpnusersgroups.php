<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vpnusersgroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vpnusersgroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('vpnuser_id')->unsigned();
            $table->bigInteger('vpngroup_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('vpnusersgroups', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('vpnusersgroups', function($table) {
            $table->foreign('vpnuser_id')->references('id')->on('vpnusers');
        });

        Schema::table('vpnusersgroups', function($table) {
            $table->foreign('vpngroup_id')->references('id')->on('vpngroups');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vpnusersgroups');
    }
}
