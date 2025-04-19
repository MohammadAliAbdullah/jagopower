<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['discount_name', 'start_date', 'end_date', 'product_id','amount','type', 'limit_qty', 'status'];
}
