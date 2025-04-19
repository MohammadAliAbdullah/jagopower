<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','slug','type','thumb', 'images','img_alt','banner', 'parent_id','content','background',
        'smm_title','smm_content','smm_images',
        'meta_title','meta_description','meta_keyword','schema', 'follow',
        'status'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
    	return $this->hasMany(Product::class, 'category_id', 'id');
    }



}
