<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelHistory extends Model
{
    use HasFactory;

    protected $table='cancelhistory';
    protected $fillable = [
        'log_id',
        'barang_id',
        'action',
        'quantity',
        'no_item',
    ];
}
