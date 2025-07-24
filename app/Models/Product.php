<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'pics',
        'video',
        'types',
        'colors',
        'stock',
        'category_id',
        'shop_id',
    ];

    protected $casts = [
        'pics' => 'array',
        'types' => 'array',
        'colors' => 'array',
    ];

    // a category that the current product belongs to
    public function category():BelongsTo{
        return $this->belongsTo(Category::class, 'category_id');
    }

    // a shop that the current product belongs to
    public function shop():BelongsTo{
        return $this->belongsTo(Shop::class, 'shop_id');
    }

}
