<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\KPH;
use App\KBM;
use App\kphtype;

class KphController extends Controller
{
    public function index()
    {
        
        return view('kph.show')->with(['datas'=>Departemen::all(), 'kphs'=>KPH::all(), 'kphtype'=>kphtype::where('is_delete','0')->get() ]);
    }

    public function create()
    {
        $datas = Departemen::all(); 
        $kbms = KBM::all();
        $kphs = KPH::all();
        $kphtype = kphtype::where('is_delete','0')->get();
        return view('kph.create', compact('datas','kbms','kphs', 'kphtype'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kph' => ['required'],
            'kbm_id' => ['required'],
            'kphtype_id' => ['required'],
        ]);

        KPH::create($request->all());
        return redirect()->route('master.kph.show')->with('success', 'Data has been created.');

    }

    public function update(Request $request, $id)
    {
        $kp = KPH::find($id);

        $request->validate([
            'name_kph' => ['required'],
            'kbm_id' => ['required'],
            'kphtype_id' => ['required'],
        ]);
        $kp->update($request->all()); 

        
        return redirect()->route('master.kph.show')->with('success', 'Data has been updated.');
    }

    public function show()
    {
        return view('kph.show')->with(['datas'=>Departemen::all(), 'kphs'=>KPH::all()]);
    }


    public function edit($id)
    {
        
        return view('kph.edit')->with(['datas'=>Departemen::all(), 'kbms'=>KBM::all() ,'kph'=>KPH::find($id), 'kphtype'=>kphtype::where('is_delete','0')->get()]);
        
    }

    public function destroy($id)
    {
        $kp = KPH::find($id);
        $kp->delete();
        return redirect()->route('master.kph.show')->with('success', 'Data has been deleted');
    }
}
