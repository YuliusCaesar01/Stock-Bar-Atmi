<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WPLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'WPLink';
    protected $fillable = [
        'order_number', // Add this line
        'no_item',
        'qr_id',
        'material',
        'jumlah',
        'satuan',
        'harga',
        'total',
        'barcode_id',
        'jenis',
        'log_id',
    ];


    public function logs()
    {
        return $this->hasMany(BarangLog::class);
    }
}
