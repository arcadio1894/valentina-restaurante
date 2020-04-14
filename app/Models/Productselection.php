<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productselection extends Model
{
    protected $fillable = [
		'option_id',
		'position',
		'is_default',
		'price',
		'qty',
		'parent_product_id',
		'parent_product_id',
		'product_id'
    ];
}