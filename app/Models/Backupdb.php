<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backupdb extends Model
{
    use HasFactory;

    protected $table = 'backup_db';

    protected $guarde= [];
}
