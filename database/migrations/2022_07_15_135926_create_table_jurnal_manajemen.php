<?php

use App\Models\Jurnal;
use App\Models\Manajemenkeuangan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJurnalManajemen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_manajemen', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jurnal::class);
            $table->foreignIdFor(Manajemenkeuangan::class);
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
        Schema::dropIfExists('jurnal_manajemen');
    }
}
