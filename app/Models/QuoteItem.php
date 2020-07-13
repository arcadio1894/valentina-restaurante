<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    protected $fillable = [
    	'quote_id',
		'parent_item_id',
		'selection_id',
		'product_id',
		'product_type',
		'name',
		'code',
		'description',
		'qty',
		'price'
	]
}
