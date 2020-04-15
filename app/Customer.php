<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $guard = 'customer';
    protected $primaryKey = 'id';
    
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

    protected $hidden = [
        'password',
        'remember_token'
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
