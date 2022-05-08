<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';

    protected $guarded = [];

    public function orang()
    {
        return $this->belongsTo(Orang::class);
    }

    public function anakketurunan()
    {
        return $this->hasMany(Keluargahubungan::class)->where('status','anak')->orderBy('urutan','ASC');
    }
    public function istri()
    {
        return $this->hasOne(Keluargahubungan::class)->where('status','istri');
    }
}
