<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventNotification extends Model
{
    public static function send(Request $requestObject)
    {
        // Get personal
        $personal = Personal::whereHas('department', function ($query) use ($requestObject) {
            $query->where('region_name', $requestObject->region_name);
        })->get();

        dd($personal);

        // Get user email

        // Send notifications
    }
}
