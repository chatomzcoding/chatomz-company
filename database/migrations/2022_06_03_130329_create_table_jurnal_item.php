<?php

use App\Models\Item;
use App\Models\Jurnal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJurnalItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_item', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jurnal::class);
            $table->foreignIdFor(Item::class);
            $table->bigInteger('harga')->nullable();
            $table->text('detail')->nullable();
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
        Schema::dropIfExists('jurnal_item');
    }
}
