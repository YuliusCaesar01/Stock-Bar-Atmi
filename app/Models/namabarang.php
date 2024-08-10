<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaBarang extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_item',
        'nama_barang',
        'kode_log',
        'kd_akun',
        'no',
        'satuan',
        'harga',
        'jumlah_minimal',
        'jumlah_maksimal',
        'rak',
        'no_katalog',
        'merk',
        'no_reff',
    ];


    public function logs()
    {
        return $this->hasMany(BarangLog::class);
    }
}
