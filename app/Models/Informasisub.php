<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasisub extends Model
{
    use HasFactory;

    protected $table = 'informasi_sub';

    protected $guarded = [];

    public function informasi()
    {
        return $this->belongsTo(Informasi::class);
    }
}
