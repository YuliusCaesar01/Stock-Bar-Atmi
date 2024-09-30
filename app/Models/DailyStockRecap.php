<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyStockRecap extends Model
{
    use HasFactory;

    // Specify the table if it does not follow Laravel's naming convention
    protected $table = 'daily_stock_recaps';

    // Define the fillable attributes
    protected $fillable = [
        'nama_barang',
        'total_jumlah',
        'recap_date'
    ];

    // Disable timestamps if you don't want them automatically maintained
    public $timestamps = true;

    // You can also define additional relationships, scopes, or helper methods here if needed
}
