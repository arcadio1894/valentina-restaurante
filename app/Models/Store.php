<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model{
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'code',
    	'image',
    	'address',
    	'phone',
    	'attention_schedule',
    	'latitude',
    	'longitude',
    	'order',
    	'status'
    ];
}