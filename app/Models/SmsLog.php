<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable=[
        'message_id','subject','content','phone','delivary','job','status'
    ];
}
