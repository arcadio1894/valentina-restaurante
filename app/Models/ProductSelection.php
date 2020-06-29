<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSelection extends Model
{
    protected $fillable = [
		'option_id',
		'position',
		'is_default',
		'price',
		'qty',
		'parent_product_id',
		'product_id'
    ];

    public function product(){
    	return $this->belongsTo('App\Models\Product','product_id');
    }
}