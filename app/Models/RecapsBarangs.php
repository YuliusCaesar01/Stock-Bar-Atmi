<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecapsBarangs extends Model
{
    protected $table = 'recaps_barangs'; // Make sure the table name is correct

    protected $fillable = [
        'no_item',
        'nama_barang',
        'kode_log',
        'jumlah',
        'recap_date',
        'harga',
        'entry',
        'exit',
    ];

    public $timestamps = false; // if you're not using created_at and updated_at columns
}
