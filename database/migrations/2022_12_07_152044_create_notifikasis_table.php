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
            $table->unsignedBigInteger('user_id_notif')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();

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
