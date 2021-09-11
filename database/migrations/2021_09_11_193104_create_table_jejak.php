<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJejak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jejak', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jejak');
            $table->text('keterangan_jejak');
            $table->text('gambar_jejak')->nullable();
            $table->float('nilai_lat')->nullable();
            $table->float('nilai_long')->nullable();
            $table->string('kategori');
            $table->date('tanggal')->nullable();
            $table->text('lokasi');
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
        Schema::dropIfExists('jejak');
    }
}
