<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['currency','invoice_no', 'callan_no', 'customer_id', 'subtotal', 'discount', 'vat', 'delivary_charge', 'total','shipping_address', 'payment_type', 'payment_status', 'cupon_id', 'cupon_amount','status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
