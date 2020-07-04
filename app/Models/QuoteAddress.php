<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteAddress extends Model
{
    protected $fillable = [
    	'quote_id',
		'customer_id',
		'customer_address_id',
		'email',
		'first_name',
		'last_name',
		'telephone',
		'document_number',
		'document_type',
		'place_type',
		'address',
		'reference',
		'latitude',
		'longitude',
		'zone_id',
		'shipping_id',
		'shipping_code',
		'shipping_name',
		'shipping_amount'
    ]
}
