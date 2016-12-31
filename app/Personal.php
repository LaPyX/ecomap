<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    public $table = 'personal';

    public $fillable = [
        'department_id',
        'name',
        'position',
        'contacts',
        'email',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo('App\\Department', 'department_id');
    }
}
