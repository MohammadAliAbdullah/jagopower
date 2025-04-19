<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable=[
        'current_balance','giftcard_balance','cashback_balance','holding_balance','customer_id'
    ];
}
