<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id','customer_id','name','phone','division_id','city_id','area_id','city','area','address','primary'
    ];
}
