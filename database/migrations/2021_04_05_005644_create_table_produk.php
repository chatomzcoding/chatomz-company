<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('slug');
            $table->text('keterangan_produk');
            $table->text('poto_produk');
            $table->text('poto_1')->nullable();
            $table->text('poto_2')->nullable();
            $table->text('poto_3')->nullable();
            $table->integer('stok');
            $table->integer('harga_produk');
            $table->integer('dilihat');
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
        Schema::dropIfExists('produk');
    }
}
