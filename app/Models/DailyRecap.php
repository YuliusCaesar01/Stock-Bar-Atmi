<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRecap extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'added',
        'subtracted',
        'recap_date',
    ];
}
