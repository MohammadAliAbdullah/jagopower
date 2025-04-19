<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoConfig extends Model
{
    use HasFactory;

    protected $fillable = ['meta_title', 'meta_keyword', 'meta_description', 'google_webmaster', 'bing_webmaster', 'yindex_webmaster', 'google_analytics', 'facebook_id', 'facebook_pixel', 'tawk', 'other_code'];
}
