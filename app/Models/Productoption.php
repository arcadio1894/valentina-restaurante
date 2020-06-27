<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productoption extends Model
{
    protected $fillable = [
    	'parent_id',
		'title',
		'is_required',
		'position',
		'type'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'id', 'parent_id');
    }

    public function selections(){
		return $this->hasMany('App\Models\Productselection','option_id')->orderBy('position');
	}

}