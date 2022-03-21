<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'id_category',
        'id_brand',
        'status',
        'sale',
        'image',
        'detail'
    ];
}
