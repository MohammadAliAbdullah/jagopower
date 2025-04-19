<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    protected $table = 'adjustments';
    use HasFactory;

    protected $fillable = ['product', 'sku', 'sized', 'stock_qty', 'action_qty', 'note', 'type', 'status'];
}
