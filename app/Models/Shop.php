<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shop extends Model
{
    protected $fillable =[
        "name",
        "description",
        "profile_pic",
        "social_links",
        "street",
        "unit",
        "address",
        "postal_code",
        "phone",
        "user_id"
    ];

    /*
     *Relationship to User
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // get all the products that the shop has
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
