<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    public $fillable = [
        'name',
        'text',
        'status'
    ];
}
