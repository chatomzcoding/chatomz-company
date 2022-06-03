<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $table = 'jurnal';

    protected $guarded = [];

    public function subkategori()
    {
        return $this->belongsTo(Subkategori::class);
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }

    public function jurnalitem()
    {
        return $this->hasMany(Jurnalitem::class);
    }
}
