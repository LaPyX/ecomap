<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Personal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = \App\Personal::where('id', '>', 0);

        if (Auth::user()->department_id) {
            $request = \App\Personal::where('department_id', Auth::user()->department_id);
        }

        $personalList = $request->with(['department'])->orderBy('name', 'asc')->get();

        return view('admin.personal.index', [
            'personalList' => $personalList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.personal.create', [
            'departments' => Department::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['department_id'] = (int)$attributes['department_id'];
        Personal::create($attributes);

        return redirect(route('admin.personal.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = Personal::find($id);

        return view('admin.personal.edit', [
            'personal' => $personal,
            'departments' => Department::all()
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
        Personal::find($id)->update($request->all());

        return redirect(route('admin.personal.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Personal::find($id)->delete();

        return redirect(route('admin.personal.index'));
    }
}
