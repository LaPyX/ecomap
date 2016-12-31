<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $fillable = [
        'name',
        'description',
        'contacts',
        'region_name',
        'status',
        'login',
        'password'
    ];
}
