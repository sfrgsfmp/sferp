<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\warehouse;
use App\Departemen;
use App\objective;
use App\Exports\WarehouseExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse.show')->with(['datas'=>Departemen::all(),'objek'=>objective::all(),'gudang'=>warehouse::where('is_delete','0')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.create')->with(['datas'=>Departemen::all(),'objek'=>objective::all(),'gudang'=>warehouse::all()]);
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
            'warehouse_name' => ['required'],
            'warehouse_code' => ['required'],
        ]);

        if (warehouse::where('warehouse_code', $request->get('warehouse_code'))->exists()) {
            // exists
            return redirect()->route('master.warehouse.index')->with('warning', 'Code already exists.');
        }else{
            warehouse::create($request->all());
            return redirect()->route('master.warehouse.index')->with('success', 'Data has been created.');
        }

        //warehouse::create($request->all());
        //return redirect()->route('master.warehouse.index')->with('success', 'Data has been created.');

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
        return view('warehouse.show')->with(['datas'=>Departemen::all(), 'objek'=>objective::all(), 'gudang'=>warehouse::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('warehouse.edit')->with(['datas'=>Departemen::all(),'objek'=>objective::all(), 'gudang'=>warehouse::find($id)]);
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
        $gudang = warehouse::find($id);

        $request->validate([
            'warehouse_name' => ['required'],
            'warehouse_code' => ['required'],
        ]);

            $gudang->update($request->all());
            return redirect()->route('master.warehouse.index')->with('success', 'Data has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gudang = warehouse::find($id);
        //$gudang->delete();
        $gudang->update(['is_delete'=>'1']);
        return redirect()->route('master.warehouse.index')->with('success', 'Data has been delete.');
    }

    public function export_excel()
	{ 
		return Excel::download(new WarehouseExport, 'warehouse.xlsx');
	}
}