<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            //main
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->notNullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('pop_id');

            //Foreign Key
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('pop_id')->references('id')->on('pops')->onDelete('cascade');

            //optional
            // $table->string('status');
            // $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
