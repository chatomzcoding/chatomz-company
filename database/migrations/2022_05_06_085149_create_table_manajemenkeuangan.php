<?php

use App\Models\Subkategori;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableManajemenkeuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manajemen_keuangan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignIdFor(Subkategori::class);
            $table->bigInteger('nominal');
            $table->string('alokasi',20);
            $table->string('waktu',20);
            $table->text('rincian')->nullable();
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
        Schema::dropIfExists('manajemen_keuangan');
    }
}
