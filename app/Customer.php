<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $guard = 'customer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'user_id',
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