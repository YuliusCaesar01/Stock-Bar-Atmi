<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'summary_date',
        'total_entry',
        'total_exit',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
