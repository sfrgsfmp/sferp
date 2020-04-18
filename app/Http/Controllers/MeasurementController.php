<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\measurement;

use Illuminate\Http\Request;


class MeasurementController extends Controller
{
    public function index()
    {
        return view('measurement.create')->with(['datas'=>Departemen::all(), 'uom'=>measurement::where('is_delete','0')->get() ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'measurement_code' => ['required'],
            'measurement_name' => ['required'],
           
        ]);


        if (measurement::where('measurement_code', $request->get('measurement_code'))->exists()) {
            // exists
            return redirect()->route('master.measurement.index')->with('warning', 'Code already exists.');
        }else{
            measurement::create($request->all());
            return redirect()->route('master.measurement.index')->with('success', 'Data has been created.');
        }
        
        //measurement::create($request->all());
        //return redirect()->route('master.measurement.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('measurement.edit')->with(['datas'=>Departemen::all(), 'uom'=>measurement::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $measurement = measurement::find($id);

        $request->validate([
            'measurement_code' => ['required'],
            'measurement_name' => ['required'],
        ]);

        if (measurement::where('measurement_code', $request->get('measurement_code'))->exists()) {
            // exists
            return redirect()->route('master.measurement.index')->with('warning', 'Code already exists.');
        }else{
            $measurement->update($request->all());
            return redirect()->route('master.measurement.index')->with('success', 'Data has been updated.');
        }

    }

    public function destroy($id)
    {
        $measurement = measurement::find($id);
        //$measurement->delete();
       // $measurement->delete(is_deket-0);
        $measurement->delete(['is_delete'=>'1']);
        return redirect()->route('master.measurement.index')->with('success', 'Data has been delete.');
    }
}
