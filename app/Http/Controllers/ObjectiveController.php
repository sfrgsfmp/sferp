<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\objective;

class ObjectiveController extends Controller
{
    public function index()
    {
        return view('objective.create')->with(['datas'=>Departemen::all(), 'objek'=>objective::where('is_delete','0')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'objective_code' => ['required'],
            'objective_name' => ['required'],
           
        ]);

        if (objective::where('objective_code', $request->get('objective_code'))->exists()) {
            // exists
            return redirect()->route('master.objective.index')->with('warning', 'Code already exists.');
        }else{
            objective::create($request->all());
            return redirect()->route('master.objective.index')->with('success', 'Data has been created.');
        }

        //objective::create($request->all());
        //return redirect()->route('master.objective.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('objective.edit')->with(['datas'=>Departemen::all(), 'objek'=>objective::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $objective = objective::find($id);

        $request->validate([
            'objective_code' => ['required'],
            'objective_name' => ['required'],
        ]);

            $objective->update($request->all());
            return redirect()->route('master.objective.index')->with('success', 'Data has been updated.');

    }

    public function destroy($id)
    {
        $objective = objective::find($id);
        //$objective->delete();
        $objective->update(['is_delete'=>'1']);
        return redirect()->route('master.objective.index')->with('success', 'Data has been delete.');
    }
}
