<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->string('judul');
            $table->string('detail');
            $table->unsignedBigInteger('keluhan_id')->nullable();
            $table->unsignedBigInteger('user_id_notif')->nullable();
            $table->unsignedBigInteger('pop_id');
            $table->string('deep_link')->nullable();
            $table->timestamps();

            $table->foreign('keluhan_id')->references('id_keluhan')->on('keluhans')->onDelete('cascade');
            $table->foreign('pop_id')->references('id_pop')->on('pops')->onDelete('cascade');
            $table->foreign('user_id_notif')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifikasis');
    }
}
