<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToHewanjenis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hewan_jenis', function (Blueprint $table) {
            $table->unsignedBigInteger('hewan_id')->after('id');
            $table->foreign('hewan_id')->references('id')->on('hewan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hewan_jenis', function (Blueprint $table) {
            //
        });
    }
}
