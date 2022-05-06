<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemenkeuangan extends Model
{
    use HasFactory;

    protected $table = 'manajemen_keuangan';

    protected $guarded = [];

    public function subkategori()
    {
        return $this->belongsTo(Subkategori::class);
    }
}
