<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'code', 'product_id', 'startdate', 'enddate', 'rewordtype', 'amount_type', 'discount_amount', 'min_amount', 'voucher_limit', 'useges_qty', 'status'];
}
