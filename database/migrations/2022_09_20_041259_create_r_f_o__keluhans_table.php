<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRFOKeluhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_f_o__keluhans', function (Blueprint $table) {
            $table->id('id_rfo_keluhan');
            $table->unsignedBigInteger('keluhan_id');
            // $table->string('id_pelanggan');
            // $table->string('nama_pelanggan');
            $table->string('nomor_tiket')->nullable();
            $table->timestamp('mulai_keluhan');
            $table->timestamp('selesai_keluhan');
            $table->string('durasi')->nullable();
            $table->string('problem');
            $table->string('action');
            $table->string('status');
            $table->string('deskripsi');
            $table->string('lampiran_rfo_keluhan')->nullable();

            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('role_id');
            // $table->unsignedBigInteger('id_balasan');


            //Foreign Key
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('keluhan_id')->references('id_keluhan')->on('keluhans')->onDelete('cascade');
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
        Schema::dropIfExists('r_f_o__keluhans');
    }
}
