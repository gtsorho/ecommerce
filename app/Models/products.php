<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = [
        'productId', 
        'store_id',
        'name',
        'description', 
        'category', 
        'stock',  
        'price', 
        'image', 
        'texture', 
        'size',
        'location',
        'color',
        'discount'
    ];

    public function getRouteKeyName()
    {
        return 'productId';
    }

}