<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTableInformasiSub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informasi_sub', function (Blueprint $table) {
            $table->unsignedBigInteger('informasi_id')->after('id');
            $table->foreign('informasi_id')->references('id')->on('informasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informasi_sub', function (Blueprint $table) {
            //
        });
    }
}
