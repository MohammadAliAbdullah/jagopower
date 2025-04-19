<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'thumb', 'images','img_alt','banner','content',
        'smm_title','smm_content','smm_images',
        'meta_title','meta_description','meta_keyword','schema', 'follow',
        'status'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
