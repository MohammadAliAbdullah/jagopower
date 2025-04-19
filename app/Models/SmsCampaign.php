<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsCampaign extends Model
{
    protected $fillable=[
        'subject','type','content','schedule','schedule_time','send_status','status'
    ];

    /*public function category()
    {
        return $this->belongsTo(DataCategory::class, 'dbcategory_id');
    }*/
}
