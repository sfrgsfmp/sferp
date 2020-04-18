<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specification;
use App\Departemen;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('specification.show')->with(['datas'=>Departemen::all(), 'specs'=>Specification::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specification.create')->with(['datas'=>Departemen::all(), 'specs'=>Specification::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'legend' => ['required'],
            'autocode' => ['required'],
            'vendorname' => ['required'],
            'type_specification' => ['required'],
        ]);

        Specification::create($request->all());
        return redirect()->route('master.specification.index')->with('success', 'Data has been created.');

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
        return view('specification.edit')->with(['datas'=>Departemen::all(), 'specs'=>Specification::find($id)]);
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
        $specs = Specification::find($id);

        $request->validate([
            'name' => ['required'],
            'legend' => ['required'],
            'autocode' => ['required'],
            'vendorname' => ['required'],
            'type_specification' => ['required'],
        ]);

        $specs->update($request->all());
        return redirect()->route('master.specification.index')->with('success', 'Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spec = Specification::find($id);
        $spec->delete();
        return redirect()->route('master.specification.index')->with('success', 'Data has been delete.');
    }
}
