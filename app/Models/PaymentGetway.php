<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGetway extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','slug','images','bank','branch_name','account_name','account_no','key','secret','inst','content','type','status'
    ];
}
