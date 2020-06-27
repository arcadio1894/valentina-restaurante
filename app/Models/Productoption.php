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

    public function selections(){
		return $this->hasMany('App\Models\Productselection','option_id')->orderBy('position');
	}

	public function selectionIds(){
		$ids = array();

		foreach ($this->selections as $selection) {
			array_push($ids, $selection->id);
		}

		return $ids;
	}
}