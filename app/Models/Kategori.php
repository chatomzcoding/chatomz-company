<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $guarded = [];

    public function subkategori()
    {
        return $this->hasMany(Subkategori::class);
    }

    public function informasi()
    {
        return $this->hasMany(Informasi::class);
    }
}
