<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBelanjaDaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_daftar', function (Blueprint $table) {
            $table->id();
            $table->integer('harga');
            $table->string('lokasi')->nullable();
            $table->enum('status_daftar',['normal','penting','kondisional']);
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
        Schema::dropIfExists('barang_daftar');
    }
}
