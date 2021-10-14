<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHewanJenis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hewan_jenis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis');
            $table->string('nama_latin_jenis');
            $table->string('tentang_jenis');
            $table->string('gambar_jenis');
            $table->string('pemakan');
            $table->string('lama_hidup')->nullable();
            $table->string('klasifikasi');
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
        Schema::dropIfExists('hewan_jenis');
    }
}
