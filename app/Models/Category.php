<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
	use SoftDeletes;
	use Sluggable;

    protected $fillable = [
		'store_id',
		'parent_id',
		'name',
		'slug',
		'description',
		'image',
		'position',
		'status',
		'level'
    ];

     public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getCreatedAtAttribute($date){
    	$date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    	$date->tz ='America/Lima' ;

	    return $date->format('d-m-Y h:i:s A');
	}

	public function parent_category(){
		return $this->belongsTo(Category::class,'parent_id');
	}

	public function products(){
		return $this->belongsToMany(Product::class)->withPivot('position');
	}
}