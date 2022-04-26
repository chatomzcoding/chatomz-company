<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupanggota extends Model
{
    use HasFactory;

    protected $table = 'grup_anggota';

    protected $guarded = [];

    public function orang()
    {
        return $this->belongsTo(Orang::class);
    }
}
