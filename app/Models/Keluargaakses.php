<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluargaakses extends Model
{
    use HasFactory;

    protected $table = 'keluarga_akses';

    protected $guarded = [];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
