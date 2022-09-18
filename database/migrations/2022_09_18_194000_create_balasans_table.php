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
            $table->id();
            // $table->string('id_balasan');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('keluhan_id');
            $table->string('balasan');
            $table->string('lampiran')->nullable();


            //Foreign Key
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('keluhan_id')->references('id')->on('keluhans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('balasan_id')->references('id')->on('balasans')->onDelete('cascade');

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
