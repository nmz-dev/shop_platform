<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
