<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productoption extends Model
{
    protected $fillable = [
    	'parent_id',
		'parent_id',
		'is_required',
		'position',
		'type'
    ];
}