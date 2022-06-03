<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnalitem extends Model
{
    use HasFactory;

    protected $table = 'jurnal_item';

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class);
    }
}
