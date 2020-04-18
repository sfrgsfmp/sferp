<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\KPH;
use App\KBM;
use App\TPK;

class TPKcontroller extends Controller
{
    public function index()
    {
        
        return view('tpk.create')->with(['datas'=>Departemen::all(), 'tpk'=>TPK::all(), 'kph'=>KPH::all()]);
    }

    public function create()
    {
        $datas = Departemen::all(); 
        $kbms = KBM::all();
        $kph = KPH::all();
        $tpk = TPK::all();
        // return view('kph.show', compact('datas'));
        return view('tpk.create', compact('datas','kbms','kph', 'tpk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_tpk' => ['required'],
            'kph_id' => ['required'],
        ]);

        TPK::create($request->all());
        return redirect()->route('master.tpk.create')->with('success', 'Data has been created.');

    }

    public function update(Request $request, $id)
    {
        $kp = TPK::find($id);

        $request->validate([
            'name_tpk' => ['required'],
            'kph_id' => ['required'],
        ]);
        $kp->update($request->all()); 

        
        return redirect()->route('master.tpk.create')->with('success', 'Data has been updated.');
    }

    public function show()
    {
        return view('tpk.create')->with(['datas'=>Departemen::all(), 'tpk'=>TPK::all()]);
    }


    public function edit($id)
    {
        
        return view('tpk.edit')->with(['datas'=>Departemen::all(), 'kbms'=>KBM::all() ,'tpk'=>TPK::find($id), 'kphs'=>KPH::all()]);
        
    }

    public function destroy($id)
    {
        $kp = TPK::find($id);
        $kp->delete();
        return redirect()->route('master.tpk.create')->with('success', 'Data has been deleted');
    }
}
