<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;

    protected $table = 'grup';

    protected $guarded = [];

    public function anggota()
    {
        return $this->hasMany(Grupanggota::class);
    }
}
