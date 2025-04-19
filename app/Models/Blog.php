<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'thumb', 'images', 'content', 'writer',
        'smm_title','smm_content','smm_images',
        'meta_title','meta_keyword','meta_description','schema','follow', 'status'
    ];

    public function seometa()
    {
        return $this->belongsTo(SeoMeta::class, 'meta_id', 'id');
    }
}
