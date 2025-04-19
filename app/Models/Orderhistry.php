<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderhistry extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id','date','time','content','user_id','status'
    ];
}
