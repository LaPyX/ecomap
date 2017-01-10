<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemPage extends Model
{
    public $fillable = [
        'name',
        'text',
        'status'
    ];
}
