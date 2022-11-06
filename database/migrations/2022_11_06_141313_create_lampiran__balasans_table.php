<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampiranBalasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lampiran__balasans', function (Blueprint $table) {
            $table->id('id_lampiran_balasan');
            $table->string('path');
            $table->unsignedBigInteger('balasan_id');
            $table->timestamps();

            $table->foreign('balasan_id')->references('id_balasan')->on('balasans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lampiran__balasans');
    }
}
