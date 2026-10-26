<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food_items';

    protected $fillable = [
        'name',
        'category',
        'price',
        'status',
        'description',
        'image'
    ];
}