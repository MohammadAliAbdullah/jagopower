<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable=[
        'branch_name','logo','favicon','hotline','phone','email','address','officetime','googlemap','imo','wechat','viber','whatsapp'
    ];

}
