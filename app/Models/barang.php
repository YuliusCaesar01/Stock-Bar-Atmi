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
        'kode_log',
        'jumlah',
        'satuan',
        'harga',
        'rak',
        'total',
        'tanggal',
        'jumlah_minimal',
        'no_katalog',
        'merk',
        'no_akun',
    ];


    public function logs()
    {
        return $this->hasMany(BarangLog::class);
    }
}
