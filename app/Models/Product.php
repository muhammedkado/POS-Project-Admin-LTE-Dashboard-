<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'purchasing_price',
        'selling_price',
        'stock',
    ];

    protected $appends = ['image_path', 'profit_percent'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . ($this->image ?: 'default.jpg'));
    }

    public function getProfitPercentAttribute()
    {
        if (! $this->purchasing_price || $this->purchasing_price == 0) {
            return 0;
        }

        return round((($this->selling_price - $this->purchasing_price) / $this->purchasing_price) * 100, 2);
    }
}
