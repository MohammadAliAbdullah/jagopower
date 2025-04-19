<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'sku', 'sized', 'colored', 'stock_qty','unit_id', 'sales_qty','purchase_qty','ragular_price', 'sales_price','purchase_price'
        ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
