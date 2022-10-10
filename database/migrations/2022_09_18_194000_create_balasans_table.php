<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balasans', function (Blueprint $table) {
            $table->id('id_balasan');
            $table->string('balasan');
            $table->string('lampiran')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('keluhan_id');

            //Foreign Key
            $table->foreign('keluhan_id')->references('id_keluhan')->on('keluhans')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');

            //Optional
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
        Schema::dropIfExists('balasans');
    }
}
