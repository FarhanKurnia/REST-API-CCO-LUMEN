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
            $table->id('id_user');
            $table->string('name');
            $table->string('avatar')->default('http://localhost:8000/avatar/user.png');
            $table->string('email')->unique()->notNullable();
            $table->string('password');
            $table->boolean('aktif')->default(true);;
            $table->boolean('online');
            $table->boolean('verifikasi')->default('false');
            $table->string('token_verifikasi')->nullable();
            $table->string('otp')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('pop_id');

            //Foreign Key
            $table->foreign('role_id')->references('id_role')->on('roles')->onDelete('cascade');
            $table->foreign('pop_id')->references('id_pop')->on('pops')->onDelete('cascade');

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
