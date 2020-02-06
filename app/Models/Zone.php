<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Zone extends Model{
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'code',
        'center',
    	'polygon',
    	'status'
    ];

    public function getCreatedAtAttribute($date){
    	$date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    	$date->tz ='America/Lima' ;

	    return $date->format('d-m-Y h:i:s A');
	}
}