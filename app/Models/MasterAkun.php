<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAkun extends Model
{
    use HasFactory;

    protected $table = 'master_akun';

    protected $fillable = [
        'kd_akun',
        'nama_akun',
        'kelompok',
    ];
}
