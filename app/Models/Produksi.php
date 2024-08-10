<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi'; // Optional, only needed if your table name doesn't match the model name

    protected $fillable = [
        'kd_prod',
        'nama_prod',
        'keterangan',
    ];
}
