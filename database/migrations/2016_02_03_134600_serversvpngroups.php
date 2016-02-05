<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Serversvpngroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serversvpngroups', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('server_id')->unsigned()->index();
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
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
        Schema::drop('serversvpngroups');
    }
}
