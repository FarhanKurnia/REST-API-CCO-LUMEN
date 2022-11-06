<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampiranKeluhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lampiran__keluhans', function (Blueprint $table) {
            $table->id('id_lampiran_keluhan');
            $table->string('path');
            $table->unsignedBigInteger('keluhan_id');
            $table->timestamps();

            $table->foreign('keluhan_id')->references('id_keluhan')->on('keluhans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lampiran__keluhans');
    }
}
