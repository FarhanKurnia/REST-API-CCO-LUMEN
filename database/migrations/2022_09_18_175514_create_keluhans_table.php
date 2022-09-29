<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id('id_keluhan');
            $table->string('id_pelanggan');
            // $table->string('nomor_keluhan')->unique();
            $table->string('nomor_keluhan');
            $table->string('source');
            $table->string('sosmed')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('pop_id');
            $table->string('nama_pelanggan')->notNullable();
            $table->string('nama_pelapor');
            $table->string('nomor_pelapor');
            $table->string('keluhan');
            $table->enum('status',['open','closed']);
            $table->string('lampiran')->nullable();
            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('role_id');
            // $table->unsignedBigInteger('id_balasan');


            //Foreign Key
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('pop_id')->references('id_pop')->on('pops')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            // $table->foreign('balasan_id')->references('id')->on('balasans')->onDelete('cascade');

            //optional
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
        Schema::dropIfExists('keluhans');
    }
}
