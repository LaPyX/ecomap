<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public $fillable = [
        'id',
        'subject',
        'address',
        'description',
        'map_point',
        'address',
        'name',
        'phone',
        'email',
        'status',
        'comment',
        'region_name'
    ];

    public static function generateId()
    {
        $out = strtoupper(str_random(5));
        $out .= '-' . date('YmdHis') . '-' . random_int(1000, 9999);

        return $out;
    }
}
