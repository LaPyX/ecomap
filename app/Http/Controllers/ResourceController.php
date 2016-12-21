<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requests.index', [
            'requests' => \App\Request::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function ajax()
    {
        $requests = \App\Request::where('status', '>=', 1)->get();
        foreach ($requests as $key => $request) {
            $requests[$key]['map_point'] = unserialize($requests[$key]['map_point']);
        }

        return response()->json([
            'requests' => $requests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        App::setLocale('ru');

        try {
            $this->validate($request, [
                'subject'     => 'required|min:3|max:255',
                'address'     => 'required|min:3|max:255',
                'description'     => 'required',
                'photo'     => '',
                'map_point'     => '',
                'name'     => 'required|min:3|max:255',
                'phone'     => 'required|min:3|max:255',
            ]);

            $attributes = $request->all();
            $attributes['map_point'] = serialize(explode(',', $attributes['map_point']));
            $attributes['status'] = 0;
            $requestObject = \App\Request::create($attributes);

            if ($request->file('photo')) {
                $path = '/images/requests/';

                if ('' !== $requestObject->photo) {
                    Storage::delete(base_path() . $path . $requestObject->image);
                }

                $imageName = $requestObject->id . '.' . $request->file('photo')->getClientOriginalExtension();
                $request->photo->move(base_path() . '/public' . $path, $imageName);
                $requestObject->photo = $path . $imageName;
                $requestObject->save();
            }
            
            return response()->json([
                'status' => 'ok'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->validator->getMessageBag()->getMessages(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = \App\Request::find($id);

        return view('requests.show', [
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

        return view('requests.edit', [
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

        return redirect(route('requests.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
