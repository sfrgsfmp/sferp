<?php

namespace App\Http\Controllers;
use App\Departemen;
use App\vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('vehicle.create')->with(['datas'=>Departemen::all(), 'vhc'=>vehicle::where('is_delete','0')->paginate(5)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_code' => ['required'],
            'vehicle_name' => ['required'],
           
        ]);


        if (vehicle::where('vehicle_code', $request->get('vehicle_code'))->exists()) {
            // exists
            return redirect()->route('master.vehicle.index')->with('warning', 'Code already exists.');
        }else{
            vehicle::create($request->all());
            return redirect()->route('master.vehicle.index')->with('success', 'Data has been created.');
        }
        
        //vehicle::create($request->all());
        //return redirect()->route('master.vehicle.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('vehicle.edit')->with(['datas'=>Departemen::all(), 'vhc'=>vehicle::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $vehicle = vehicle::find($id);

        $request->validate([
            'vehicle_code' => ['required'],
            'vehicle_name' => ['required'],
        ]);

            $vehicle->update($request->all());
            return redirect()->route('master.vehicle.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $vehicle = vehicle::find($id);
        //$vehicle->delete();
        $vehicle->update(['is_delete'=> '1']);
        return redirect()->route('master.vehicle.index')->with('success', 'Data has been delete.');
    }
}
