<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
	use SoftDeletes;
	use Sluggable;

	protected $fillable = [
		'store_id',
		'code',
		'name',
		'slug',
		'description',
		'type',
		'small_image',
		'image',
		'price',
		'initial_stock',
		'stock',
		'position',
		'visibility',
		'status'
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

	public function categories(){
		return $this->belongsToMany(Category::class)->withPivot('position');
	}

	public function getCategoryIds(){
		$ids = array();

		foreach($this->categories as $category){
			array_push($ids, $category->id);
		}

		return $ids;
	}

	public function options(){
		return $this->hasMany('App\Models\Productoption','parent_id')->orderBy('position');
	}

	public function optionIds(){
		$ids = array();

		foreach ($this->options as $option) {
			array_push($ids, $option->id);
		}

		return $ids;
	}

}