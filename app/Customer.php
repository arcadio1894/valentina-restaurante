<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model 
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'type_doc',
        'document',
        'birthday',
        'genre',
        'phone',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function locations() {
        return $this->hasMany('App\Models\Location');
    }

    protected $dates = [
        'deleted_at'
    ];
}
