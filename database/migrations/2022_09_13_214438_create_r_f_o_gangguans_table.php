<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRFOGangguansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_f_o_gangguans', function (Blueprint $table) {
            $table->id('id_rfo_gangguan');
            $table->string('nomor_rfo_gangguan')->nullable();
            $table->string('problem');
            $table->string('action');
            $table->string('deskripsi');
            $table->string('status');
            $table->timestamp('mulai_gangguan');
            $table->timestamp('selesai_gangguan')->nullable();
            $table->string('nomor_tiket')->nullable();
            $table->string('durasi')->nullable();


            $table->unsignedBigInteger('user_id');

            //Foreign Key
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('r_f_o_gangguans');
    }
}
