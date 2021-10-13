<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTableBarangDaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_daftar', function (Blueprint $table) {
            $table->unsignedBigInteger('barangbelanja_id')->after('id');
            $table->foreign('barangbelanja_id')->references('id')->on('barang_belanja')->onDelete('cascade');
            $table->unsignedBigInteger('barang_id')->after('barangbelanja_id');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_daftar', function (Blueprint $table) {
            //
        });
    }
}
