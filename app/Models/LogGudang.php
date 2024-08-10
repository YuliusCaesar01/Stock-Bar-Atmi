<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogGudang extends Model
{
    use HasFactory;

    protected $table = 'log_gudangs_tables'; // Optional, only needed if your table name doesn't match the model name

    protected $fillable = [
        'kd_prod',
        'kd_log',
        'nama_log',
        'keterangan',
    ];
}
