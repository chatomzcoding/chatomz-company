<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToLinimasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('linimasa', function (Blueprint $table) {
            $table->unsignedBigInteger('orang_id')->after('id');
            $table->foreign('orang_id')->references('id')->on('orang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('linimasa', function (Blueprint $table) {
            //
        });
    }
}
