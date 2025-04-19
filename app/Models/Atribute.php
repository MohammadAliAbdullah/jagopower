<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribute extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','value', 'images', 'parent_id'];

    public function attribute_parent()
    {
        return $this->belongsTo('App\Models\Atribute', 'parent_id', 'id');
    }
}
