<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\handling;
use App\Departemen;
use App\section;
use App\measurement;
use App\currency;
use App\Http\Controllers\Controller;

class HandlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('handling.show')->with(['datas'=>Departemen::all(),'seksinya'=>section::all(),'cry'=>currency::all(),'uom'=>measurement::all(),'hand'=>handling::where('is_delete','0')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('handling.create')->with(['datas'=>Departemen::all(),'seksinya'=>section::all(),'cry'=>currency::all(),'uom'=>measurement::all(),'hand'=>handling::all()]);
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
            'code' => ['required'],
        ]);

        if (handling::where('code', $request->get('code'))->exists()) {
            // exists
            return redirect()->route('master.handling.index')->with('warning', 'Code already exists.');
        }else{
            handling::create($request->all());
            return redirect()->route('master.handling.index')->with('success', 'Data has been created.');
        }

        //handling::create($request->all());
        //return redirect()->route('master.handling.index')->with('success', 'Data has been created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        return view('handling.show')->with(['datas'=>Departemen::all(), 'seksinya'=>section::all(),'cry'=>currency::all(),'uom'=>measurement::all(), 'hand'=>handling::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('handling.edit')->with(['datas'=>Departemen::all(),'seksinya'=>section::all(),'cry'=>currency::all(),'uom'=>measurement::all(), 'hand'=>handling::find($id)]);
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
        $hand = handling::find($id);

        $request->validate([
            'name' => ['required'],
            'code' => ['required'],
        ]);

            $hand->update($request->all());
            return redirect()->route('master.handling.index')->with('success', 'Data has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hand = handling::find($id);
        //$hand->delete();
        $hand->update(['is_delete'=>'1']);
        return redirect()->route('master.handling.index')->with('success', 'Data has been delete.');
    }

    public function export_excel()
	{ 
		return Excel::download(new handlingExport, 'handling.xlsx');
	}
}