<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'type_doc',
        'document',
        'address',
        'latitude',
        'longitude',
        'type_place',
        'reference',
    ];

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    protected $dates = [
        'deleted_at'
    ];
}
