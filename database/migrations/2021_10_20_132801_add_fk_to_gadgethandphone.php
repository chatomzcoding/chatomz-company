<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToGadgethandphone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gadget_handphone', function (Blueprint $table) {
            $table->unsignedBigInteger('merk_id')->after('id');
            $table->foreign('merk_id')->references('id')->on('merk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gadget_handphone', function (Blueprint $table) {
            //
        });
    }
}
