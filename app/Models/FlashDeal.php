<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','start_date','end_date','status','featured','background_color','text_color','banner','slug','amount','type'
    ];
}
