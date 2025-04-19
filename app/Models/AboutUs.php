<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable=[
        'about_title','content','images','mission','vision','establistmet','outlet','total_delivary'
    ];
}
