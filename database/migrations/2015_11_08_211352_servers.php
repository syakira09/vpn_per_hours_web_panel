<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Servers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('machine_id')->nullable();
            $table->string('zone')->nullable();
            $table->string('true_zone')->nullable();
            $table->string('provider')->nullable();
            $table->string('status')->nullable();
            $table->string('name');
            $table->string('ip')->nullable();
            $table->boolean('random')->default(0);
            $table->string('token');
            $table->float('time')->default(0);
            $table->timestamps();
        });

        Schema::table('servers', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');
    }
}
