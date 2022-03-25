<?php

use App\Models\Orang;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usaha', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Orang::class);
            $table->string('nama_usaha');
            $table->text('lokasi');
            $table->text('gambar_lokasi')->nullable();
            $table->text('bidang');
            $table->longText('detail')->nullable();
            $table->enum('status',['buka','tutup','tutup sementara']);
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
        Schema::dropIfExists('usaha');
    }
}
