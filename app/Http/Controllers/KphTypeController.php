<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\kphtype;

use Illuminate\Http\Request;


class KphTypeController extends Controller
{
    public function index()
    {
        return view('kphtype.create')->with(['datas'=>Departemen::all(), 'kpht'=>kphtype::where('is_delete','0')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
           
        ]);


        if (kphtype::where('class_code', $request->get('class_code'))->exists()) {
            // exists
            return redirect()->route('master.kphtype.index')->with('warning', 'Code already exists.');
        }else{
            kphtype::create($request->all());
            return redirect()->route('master.kphtype.index')->with('success', 'Data has been created.');
        }
        
        //kphtype::create($request->all());
        //return redirect()->route('master.kphtype.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('kphtype.edit')->with(['datas'=>Departemen::all(), 'kpht'=>kphtype::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $kphtype = kphtype::find($id);

        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
        ]);

            $kphtype->update($request->all());
            return redirect()->route('master.kphtype.index')->with('success', 'Data has been updated.');

    }

    public function destroy($id)
    {
        $kphtype = kphtype::find($id);
        //$kphtype->delete();
        $kphtype->update(['is_delete'=>'1']);
        return redirect()->route('master.kphtype.index')->with('success', 'Data has been delete.');
    }
}