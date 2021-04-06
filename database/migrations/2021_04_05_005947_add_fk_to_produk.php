<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->unsignedBigInteger('toko_id')->after('id');
            $table->foreign('toko_id')->references('id')->on('toko')->onDelete('cascade');
            $table->unsignedBigInteger('kategoriproduk_id')->after('user_id');
            $table->foreign('kategoriproduk_id')->references('id')->on('kategori_produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            //
        });
    }
}
