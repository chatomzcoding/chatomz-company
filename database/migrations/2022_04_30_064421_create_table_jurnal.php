<?php

use App\Models\Subkategori;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subkategori::class);
            $table->string('nama_jurnal');
            $table->string('tempat')->nullable();
            $table->date('tanggal');
            $table->date('garansi')->nullable();
            $table->time('jam')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('status',50); // selesai, rencana
            $table->string('label')->nullable();
            $table->string('struk')->nullable();
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
        Schema::dropIfExists('jurnal');
    }
}
