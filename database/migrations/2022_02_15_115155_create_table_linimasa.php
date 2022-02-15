<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLinimasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linimasa', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('jam')->nullable();
            $table->string('icon')->nullable();
            $table->string('nama');
            $table->text('keterangan');
            $table->text('tag')->nullable();
            $table->text('info')->nullable();
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
        Schema::dropIfExists('linimasa');
    }
}
