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
        'password',
        'type_doc',
        'num_doc',
        'birthday',
        'genre',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $dates = [
        'deleted_at'
    ];
}