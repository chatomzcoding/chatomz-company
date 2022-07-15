<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnalmanajemen extends Model
{
    use HasFactory;

    protected $table = 'jurnal_manajemen';

    protected $guarded = [];

    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class);
    }

    public function manajemenkeuangan()
    {
        return $this->belongsTo(Manajemenkeuangan::class);
    }
}
