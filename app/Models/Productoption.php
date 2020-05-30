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
}