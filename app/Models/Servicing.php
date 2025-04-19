<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicing extends Model
{
    use HasFactory;

    protected $fillable=[
        'customer_id','phone','address','complain','solution','product_model','technician','amount','date','admin_id','status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
