<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsContent extends Model
{
    protected $fillable=[
        'subject','content','admin_id','status'
    ];
}
