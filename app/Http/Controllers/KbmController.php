<?php

namespace App\Http\Controllers;
use App\Departemen;
use App\KBM;
use Illuminate\Http\Request;
use App\IndProv;

class KbmController extends Controller
{
    public function index()
    {
        return view('kbm.create')->with(['datas'=>Departemen::all(), 'kbms'=>KBM::all(), 'prov'=>IndProv::all() ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'province_id' => ['required'],
            'name_kbm' => ['required'],
           
        ]);

        KBM::create($request->all());
        return redirect()->route('master.kbm.index')->with('success', 'Data has been created.');

    }

    public function edit($id)
    {
        
        return view('kbm.edit')->with(['datas'=>Departemen::all(), 'kbms'=>KBM::find($id), 'prov'=>IndProv::all()]);
        
    }

    public function update(Request $request, $id)
    {
        $kbm = KBM::find($id);

        $request->validate([
            'province_id' => ['required'],
            'name_kbm' => ['required'],
        ]);

        $kbm->update($request->all());
        return redirect()->route('master.kbm.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $kbm = KBM::find($id);
        $kbm->delete();
        return redirect()->route('master.kbm.index')->with('success', 'Data has been delete.');
    }
}
