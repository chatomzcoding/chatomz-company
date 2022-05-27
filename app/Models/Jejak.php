<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jejak extends Model
{
    use HasFactory;

    protected $table = 'jejak';

    protected $guarded = [];

    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }
}
