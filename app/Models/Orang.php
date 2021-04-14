<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orang extends Model
{
    use HasFactory;

    protected $table = 'orang';

    protected $guarded = [];

    public function kontak()
    {
        return $this->hasOne(Kontak::class);
    }

    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class);
    }
}
