<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_barcode', // Add this line
        'no_item',
        'nama_barang',
        'kd_akun',
        'kode_log',
        'kd_unit',
        'jumlah',
        'satuan',
        'harga',
        'rak',
        'total',
        'tanggal',
        'jumlah_minimal',
        'jumlah_maksimal',
        'no_katalog',
        'merk',
        'no_akun',
        'no_reff',
    ];


    public function logs()
    {
        return $this->hasMany(BarangLog::class);
    }
}
