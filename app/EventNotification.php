<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EventNotification extends Model
{
    const EVENT_NEW_REQUEST  = 0;
    const EVENT_EDIT_REQUEST = 1;

    public static function send($eventType, $params)
    {
        switch ($eventType) {
            case EventNotification::EVENT_NEW_REQUEST:
                self::eventNewRequest($params);
                break;
            case EventNotification::EVENT_EDIT_REQUEST:
                self::eventEditRequest($params->request);
                break;
        }
    }

    private static function eventRequest($params)
    {
        $personal = Personal::whereHas('department', function ($query) use ($params) {
            $query->where('region_name', $params['request']->region_name);
        })->get();

        foreach ($personal as $person) {
            if ('' == $person->email) {
                continue;
            }

            self::sendRequestEmail([
                'email' => $person->email,
                'name'  => $person->name,
            ], 'Новое обращение', $params['template']['admin'], $params['request']);
        }

        if ('' == $params['request']->email) {
            return;
        }

        self::sendRequestEmail([
            'email' => $params['request']->email,
            'name'  => $params['request']->name,
        ], 'Ваше обращение принято', $params['template']['user'], $params['request']);
    }

    private static function eventNewRequest($params)
    {
        $params = [
            'request'  => $params,
            'template' => [
                'admin' => 'emails.requests.new-admin',
                'user'  => 'emails.requests.new-user',
            ],
            'subject' => [
                'admin' => 'Новое обращение',
                'user'  => 'Ваше обращение принято',
            ],
        ];

        self::eventRequest($params);
    }

    private static function eventEditRequest($request)
    {
        self::sendRequestEmail([
            'email' => $request['request']->email,
            'name'  => $request['request']->name,
        ], 'Изменён статус обращения', 'emails.requests.update', $request);
    }

    private static function sendRequestEmail($to, $subject, $template, $request)
    {
        Mail::send($template, ['request' => $request], function ($m) use ($to, $subject, $request) {
            $m->from('noreply@ecomap.addedvalue.online', 'Интерактивная карта незаконных свалок');

            $m->to($to['email'], $to['name'])->subject($subject);
        });
    }
}
