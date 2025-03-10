<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'action',
        'quantity',
        'created_at',
        'order_number',
        'no_item',
        'satuan',
        'operator',
        'harga',
        'no_po',
        'jenis',
        'kd_log',
        'no_barang',
        'nama_barang'
        // Add other fields if needed
    ];

    public function barang()
{
    return $this->belongsTo(Barang::class);
}

    // Define relationships and other model methods here
}
