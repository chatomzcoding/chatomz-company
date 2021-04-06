<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInfoWebsite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_website', function (Blueprint $table) {
            $table->id();
            $table->string('email',100);
            $table->string('telp',20);
            $table->string('teks_atas');
            $table->string('tentang');
            $table->string('alamat');
            $table->string('maps');
            $table->text('logo_brand');
            $table->text('bg_produk');
            $table->string('link_fb')->nullable();
            $table->string('link_tw')->nullable();
            $table->string('link_yt')->nullable();
            $table->string('link_in')->nullable();
            $table->string('link_pi')->nullable();
            $table->string('link_ig')->nullable();
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
        Schema::dropIfExists('info_website');
    }
}
