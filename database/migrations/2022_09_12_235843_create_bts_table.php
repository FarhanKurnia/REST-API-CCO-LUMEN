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
            $table->id();
            $table->string('nama_bts');
            $table->string('nama_pic');
            $table->string('nomor_pic');
            $table->string('lokasi');
            $table->unsignedBigInteger('pop_id');
            $table->unsignedBigInteger('user_id');
            $table->string('kordinat');


            //Foreign Key
            $table->foreign('pop_id')->references('id')->on('pops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //optional
            // $table->string('status');
            // $table->timestamp('email_verified_at')->nullable();

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
