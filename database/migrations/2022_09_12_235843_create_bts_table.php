<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bts', function (Blueprint $table) {
            //main
            $table->id('id_bts');
            $table->string('nama_bts');
            $table->string('nama_pic');
            $table->string('nomor_pic');
            $table->string('lokasi');
            $table->unsignedBigInteger('pop_id');
            $table->unsignedBigInteger('user_id');
            $table->string('kordinat');
            $table->string('deskripsi')->nullable();



            //Foreign Key
            $table->foreign('pop_id')->references('id_pop')->on('pops')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('bts');
    }
}
