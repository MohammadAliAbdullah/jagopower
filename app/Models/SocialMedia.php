<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    protected $fillable=[
        'branch_id','facebook','twitter','linkedin','instagram','youtube','tiktak'
    ];

    public function company(){
        return $this->belongsTo('App\Models\ContactInfo','branch_id');
    }
}
