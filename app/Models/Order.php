<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Shop;

class Order extends Model
{
    protected $fillable = [
        'no',
        'delivery_date',
        'remark',
        'user_code',
        'pics',
        'types',
        'colors',
        'status',
        'shop_id'
    ];

    // Relationship: each Order belongs to one Shop
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
}
