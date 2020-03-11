<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'user_id',
        'type_doc',
        'birthday',
        'genre',
        'phone',
        'address',
        'type_place',
        'reference',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    protected $dates = [
        'deleted_at'
    ];
}
