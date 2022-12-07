<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasiReadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasi__reads', function (Blueprint $table) {
            $table->id('id_notifikasiread');
            $table->boolean('is_read');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('notifikasi_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('notifikasi_id')->references('id_notifikasi')->on('notifikasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifikasi__reads');
    }
}
