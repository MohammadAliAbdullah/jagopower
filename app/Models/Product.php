<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\ProductStock;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'sku',
        'category_id', 'sub_category_id', 'sub_subcategory_id','spacialcat_id','brand_id', 'unit_id','qty','color','size','blade',
        'content','specification','warrenty','regular_price','sales_price', 'featured','thumb', 'images','img_alt','gallery', 'video',
        'smm_title','smm_content','smm_images','meta_tags',
        'meta_title','meta_description','meta_keyword','schema', 'follow',
        'status'];


    public function productstock()
    {
        return $this->hasOne(ProductStock::class, 'sku', 'sku');
    }


    public function brand()
    {
       return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'meta_tags', 'id');
    }
}
