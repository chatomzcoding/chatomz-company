<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGadgetHandphone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gadget_handphone', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gadget');
            $table->text('keterangan');
            $table->text('gambar');
            $table->text('kamera')->nullable();
            $table->text('layar')->nullable();
            $table->text('platform')->nullable();
            $table->text('baterai')->nullable();
            $table->text('body')->nullable();
            $table->text('network')->nullable();
            $table->text('memori')->nullable();
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
        Schema::dropIfExists('gadget_handphone');
    }
}
