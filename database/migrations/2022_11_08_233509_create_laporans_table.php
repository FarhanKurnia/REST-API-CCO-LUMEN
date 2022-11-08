<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('nomor_laporan');
            $table->date('tanggal');
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('pop_id');
            $table->string('petugas');
            $table->unsignedBigInteger('user_id');
            $table->string('lampiran_laporan');
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('pop_id')->references('id_pop')->on('pops')->onDelete('cascade');
            $table->foreign('shift_id')->references('id_shift')->on('shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
