<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Product extends Model
{
	use SoftDeletes;

	$fillable = [
		'store_id',
		'code',
		'name',
		'description',
		'type',
		'small_image',
		'image',
		'price',
		'initial_stock',
		'stock',
		'position',
		'status'
	];

	public function getCreatedAtAttribute($date){
    	$date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    	$date->tz ='America/Lima' ;

	    return $date->format('d-m-Y h:i:s A');
	}
}