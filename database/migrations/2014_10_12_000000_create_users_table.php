<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('country');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->float('credit')->default(0);
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('activated')->default(False);
            $table->string('confirmation_code')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
