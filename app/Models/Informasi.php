<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi';

    protected $guarded = [];

    public function informasisub()
    {
        return $this->hasMany(Informasisub::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
