<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
    	'store_id',
		'is_active',
		'status',
		'customer_id',
		'customer_email',
		'customer_firstname',
		'customer_lastname',
		'payment_id',
		'payment_code',
		'payment_name',
		'subtotal',
		'grand_total'
    ]
}
