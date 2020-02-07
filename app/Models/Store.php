<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model{
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'code',
        'service',
    	'image',
    	'address',
    	'phone',
    	'attention_schedule',
    	'latitude',
    	'longitude',
    	'order',
    	'status'
    ];
	
	public function getCreatedAtAttribute($date){
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
		$date->tz ='America/Lima' ;

		return $date->format('d-m-Y h:i:s A');
	}

	protected $dates = ['delete_at'];
    
	
}