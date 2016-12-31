<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public $fillable = [
        'subject',
        'address',
        'description',
        'map_point',
        'address',
        'name',
        'phone',
        'status',
        'comment',
        'region_name'
    ];
}
