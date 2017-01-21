<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\EventNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
{
    public function index()
    {
        $request = \App\Request::where('created_at', '>', 0);

        if (Auth::user()->department_id) {
            $department = Department::find((int)Auth::user()->department_id);
            $request = \App\Request::where('region_name', $department->region_name);
        }

        $var = $request->orderBy('created_at', 'desc')->get();
        foreach ($var as $key => $value) {
            $photos = @unserialize($value['photo']);
            $var[$key]['photo'] = $photos[0];
        }

        return view('admin.requests.index', [
            'requests' => $var
        ]);
    }

    public function show($id)
    {
        $request = \App\Request::find($id);

        return view('admin.requests.show', [
            'request' => $request
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $requestObject = \App\Request::find($id);
        $requestObject->photo = @unserialize($requestObject->photo);

        return view('admin.requests.edit', [
            'request' => $requestObject
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestObject = \App\Request::where('id', $id)->first();
        $requestObject->status = $request->status;
        $requestObject->comment = $request->comment;
        $requestObject->save();

        if ($request->status) {
            EventNotification::send(EventNotification::EVENT_EDIT_REQUEST, $requestObject);
        }

        return redirect(route('admin.requests.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requestObject = \App\Request::where('id', $id)->first();
        $requestObject->delete();

        return redirect(route('admin.requests.index'));
    }
}
