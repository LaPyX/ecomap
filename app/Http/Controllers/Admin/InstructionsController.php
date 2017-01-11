<?php

namespace App\Http\Controllers\Admin;

use App\Instruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstructionsController extends Controller
{
    private $baseRoute = 'admin.instructions.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ('' != $request->search) {
            $itemsList = Instruction::where('name', 'LIKE', '%' . $request->search . '%')->orderBy('name', 'asc')->get();
        } else {
            $itemsList = Instruction::orderBy('name', 'asc')->get();
        }

        return view($this->baseRoute . 'index', [
            'itemsList' => $itemsList,
            'baseRoute' => $this->baseRoute
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->baseRoute . 'create', [
            'baseRoute' => $this->baseRoute
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
        Instruction::create($attributes);

        return redirect(route($this->baseRoute . 'index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Instruction::find($id);

        return view($this->baseRoute . 'show', [
            'item' => $item,
            'baseRoute' => $this->baseRoute
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Instruction::find($id);

        return view($this->baseRoute . 'edit', [
            'item' => $item,
            'baseRoute' => $this->baseRoute
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
        Instruction::find($id)->update($request->all());

        return redirect(route($this->baseRoute . 'index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Instruction::find($id)->delete();

        return redirect(route($this->baseRoute . 'index'));
    }
}
