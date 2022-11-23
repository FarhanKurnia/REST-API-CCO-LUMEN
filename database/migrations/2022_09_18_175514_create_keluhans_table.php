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
            $table->string('nomor_keluhan');
            $table->unsignedBigInteger('sumber_id');
            $table->string('detail_sumber');
            $table->unsignedBigInteger('pop_id');
            $table->string('id_pelanggan');
            $table->string('nama_pelanggan')->notNullable();
            $table->string('nama_pelapor');
            $table->string('nomor_pelapor');
            $table->string('keluhan');
            $table->string('sentimen_analisis')->nullable();
            $table->enum('status',['open','closed']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rfo_gangguan_id')->nullable();
            $table->unsignedBigInteger('rfo_keluhan_id')->nullable();



            //Foreign Key
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('pop_id')->references('id_pop')->on('pops')->onDelete('cascade');
            $table->foreign('rfo_gangguan_id')->references('id_rfo_gangguan')->on('r_f_o_gangguans')->onDelete('cascade');
            $table->foreign('rfo_keluhan_id')->references('id_rfo_keluhan')->on('r_f_o__keluhans')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('sumber_id')->references('id_sumber')->on('sumber_keluhans')->onDelete('cascade');

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
