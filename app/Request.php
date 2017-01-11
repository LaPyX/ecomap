<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public $incrementing = false;

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
        'region_name',
        'user_id'
    ];

    public static function generateId()
    {
        $out = date('ymd') . '-' . random_int(100, 999);

        return $out;
    }
    
    public function user()
    {
        return $this->belongsTo('App\\User', 'user_id');
    }
}
