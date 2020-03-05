<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    $fillable = [
    	'category_id',
    	'product_id',
    	'position'
    ];
}