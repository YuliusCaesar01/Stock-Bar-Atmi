<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $connection = 'WPDATABASE'; // Specify the correct connection name
    protected $table = 'order';
    protected $fillable = [
        'order_number',
        'so_number',
        'quotation_number',
        'kbli_code',
        'reff_number',
        'order_date',
        'product_type',
        'po_number',
        'sale_price',
        'production_cost',
        'information',
        'information2',
        'information3',
        'order_status',
        'customer',
        'product',
        'qty',
        'dod',
        'dod_forecast',
        'sample',
        'material',
        'catalog_number',
        'material_cost',
        'dod_adj',
    ];

}
