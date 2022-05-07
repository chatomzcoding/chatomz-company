<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluargahubungan extends Model
{
    use HasFactory;
    
    protected $table = 'keluarga_hubungan';

    protected $guarded = [];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }

    public function orang()
    {
        return $this->belongsTo(Orang::class);
    }
}
