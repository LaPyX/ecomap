<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EventNotification extends Model
{
    public static function send(Request $requestObject)
    {
        $personal = Personal::whereHas('department', function ($query) use ($requestObject) {
            $query->where('region_name', $requestObject->region_name);
        })->get();

        foreach ($personal as $person) {
            if ('' == $person->email) {
                continue;
            }

            Mail::send('emails.requests.new-admin', ['request' => $requestObject, 'user' => $person], function ($m) use ($requestObject, $person) {
                $m->from('noreply@ecomap.addedvalue.online', 'Интерактивная карта незаконных свалок');

                $m->to($person->email, $person->name)->subject('Новое обращение');
            });
        }

        if ('' == $requestObject->email) {
            return;
        }
        
        Mail::send('emails.requests.new-user', ['request' => $requestObject], function ($m) use ($requestObject) {
            $m->from('noreply@ecomap.addedvalue.online', 'Интерактивная карта незаконных свалок');

            $m->to($requestObject->email, $requestObject->name)->subject('Ваше обращение принято');
        });
    }
}
