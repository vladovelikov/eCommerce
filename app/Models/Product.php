<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'vendor_id', 'category_id', 'subcategory_id', 'child_category_id', 'brand_id', 'quantity', 'short_description', 'long_description', 'video_url', 'sku', 'price', 'offer_price', 'offer_start_date', 'offer_end_date', 'product_type', 'status', 'seo_title', 'seo_description', 'image'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
