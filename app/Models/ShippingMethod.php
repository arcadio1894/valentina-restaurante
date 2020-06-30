<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ShippingMethod extends Model
{
	use Sluggable;

    protected $fillable = [
    	'store_id',
    	'name',
    	'code',
    	'image',
    	'position',
    	'status'
    ];

    public function sluggable(){
        return [
            'code' => [
                'source' => 'name'
            ]
        ];
    }
}
