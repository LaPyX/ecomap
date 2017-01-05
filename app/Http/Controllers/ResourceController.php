<?php

namespace App\Http\Controllers;

use App\Department;
use App\EventNotification;
use App\Personal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ResourceController extends Controller
{
    public function ajax()
    {
        $requests = \App\Request::where('status', '>=', 1)->get();
        foreach ($requests as $key => $request) {
            $requests[$key]['map_point'] = unserialize($requests[$key]['map_point']);
            $requests[$key]['photo']     = @unserialize($requests[$key]['photo']);
        }

        return response()->json([
            'requests' => $requests,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        App::setLocale('ru');

        try {
            $id = \App\Request::generateId();

            $this->validate($request, [
                'subject'     => 'required|min:3|max:255',
                'address'     => 'required|min:3|max:255',
                'description' => 'required',
                'photo'       => '',
                'map_point'   => '',
                'name'        => 'required|min:3|max:255',
                'phone'       => 'required|min:3|max:255',
            ]);

            $attributes              = $request->all();
            $attributes['map_point'] = serialize(explode(',', $attributes['map_point']));
            $attributes['status']    = 0;
            $attributes['id']        = $id;

            // Create new user if not authorized
            $password = str_random();

            $user = User::create([
                'name'     => $attributes['name'],
                'email'    => $attributes['email'],
                'password' => bcrypt($password),
            ]);

            $requestObject           = \App\Request::create($attributes);

            if ($request->file('photo')) {
                $path = '/images/requests/';

                $files = [];

                foreach ($request->file('photo') as $file) {
                    $imageName = $requestObject->id . '-' . str_random() . '.' . $file->getClientOriginalExtension();
                    $file->move(base_path() . '/public' . $path, $imageName);
                    $files[] = $path . $imageName;
                }

                $requestObject->photo = serialize($files);
                $requestObject->save();
            }

            $requestObject->password = $password;

            EventNotification::send($requestObject);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->validator->getMessageBag()->getMessages(),
            ], 422);
        }
    }

    public function getDepartmentInfo(Request $request)
    {
        $department = Department::where('region_name', $request->region_name)->first();

        $department->description = nl2br($department->description);
        $department->contacts    = nl2br($department->contacts);

        $department->personal = Personal::where('department_id', $department->id)->get();

        return response()->json([
            'status'     => 'ok',
            'department' => $department,
            'requested'  => $request->region_name,
        ]);
    }
}
