<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToJejakPoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jejak_poto', function (Blueprint $table) {
            $table->unsignedBigInteger('jejak_id')->after('id');
            $table->foreign('jejak_id')->references('id')->on('jejak')->onDelete('cascade');
            $table->unsignedBigInteger('orang_id')->after('jejak_id');
            $table->foreign('orang_id')->references('id')->on('orang')->onDelete('cascade');
            $table->string('ket_poto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jejak_poto', function (Blueprint $table) {
            //
        });
    }
}
