<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'thumb', 'images', 'content','background',
        'smm_title','smm_content','smm_images',
        'meta_title','meta_keyword','meta_description','schema','follow', 'status'];

}
