<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ('' != $request->search) {
            $departments = Department::where('region_name', 'LIKE', '%' . $request->search . '%')->orWhere('name', 'LIKE', '%' . $request->search . '%')->orderBy('region_name', 'asc')->get();
        } else {
            $departments = Department::orderBy('region_name', 'asc')->get();
        }


        return view('admin.departments.index', [
            'departments' => $departments,
            'search' => '' != $request->search ? $request->search : false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
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
        // Validate

        // Create user
        $inputs     = $request->all();
        $department = Department::create($inputs);

        $password = str_random();
        $login    = strtolower(str_random(6) . '@ecomap.ru');

        User::create([
            'name'          => $request->region_name,
            'email'         => $login,
            'password'      => Hash::make($password),
            'department_id' => $department->id,
        ]);

        $department->login    = $login;
        $department->password = $password;
        $department->save();

        return redirect(route('admin.departments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);

        return view('admin.departments.edit', [
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Department::find($id)->update($request->all());

        return redirect(route('admin.departments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::find($id)->delete();

        return redirect(route('admin.departments.index'));
    }
}
