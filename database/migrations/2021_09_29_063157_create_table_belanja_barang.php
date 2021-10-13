<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBelanjaBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_belanja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_belanja');
            $table->text('keterangan_belanja');
            $table->date('tgl_belanja')->nullable();
            $table->integer('budget')->nullable();
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
        Schema::dropIfExists('barang_belanja');
    }
}
