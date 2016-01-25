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
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('vpn_user_id')->unsigned()->index();
            $table->foreign('vpn_user_id')->references('id')->on('vpnusers')->onDelete('cascade');
            $table->bigInteger('vpn_group_id')->unsigned()->index();
            $table->foreign('vpn_group_id')->references('id')->on('vpngroups')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usersgroups');
    }
}
