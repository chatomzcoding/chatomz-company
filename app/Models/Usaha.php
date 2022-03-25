<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    use HasFactory;

    protected $table = 'usaha';

    protected $guarded = [];

    public function orang()
    {
        return $this->belongsTo(Orang::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
