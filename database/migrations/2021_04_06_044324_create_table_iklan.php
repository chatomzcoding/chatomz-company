<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableIklan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iklan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_iklan');
            $table->string('deskripsi');
            $table->text('gambar_iklan');
            $table->string('posisi');
            $table->string('link')->nullable();
            $table->string('teks_kecil')->nullable();
            $table->string('teks_penting')->nullable();
            $table->string('nama_link',50)->nullable();
            $table->enum('status',['aktif','tidak aktif']);
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
        Schema::dropIfExists('iklan');
    }
}
