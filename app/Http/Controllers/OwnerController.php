<?php

namespace App\Http\Controllers;
use App\Departemen;
use App\owner;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        return view('owner.create')->with(['datas'=>Departemen::all(), 'own'=>owner::where('is_delete','0')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_code' => ['required'],
            'owner_name' => ['required'],
            'owner_legend' => ['required'],
        ]);

        if (owner::where('owner_code', $request->get('owner_code'))->exists()) {
            // exists
            return redirect()->route('master.owner.index')->with('warning', 'Code already exists.');
        }else{
            owner::create($request->all());
            return redirect()->route('master.owner.index')->with('success', 'Data has been created.');
        }

        //owner::create($request->all());
        //return redirect()->route('master.owner.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('owner.edit')->with(['datas'=>Departemen::all(), 'own'=>owner::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $owner = owner::find($id);

        $request->validate([
            'owner_code' => ['required'],
            'owner_name' => ['required'],
            'owner_legend' => ['required'],
        ]);

            $owner->update($request->all());
            return redirect()->route('master.owner.index')->with('success', 'Data has been updated.');

    }

    public function destroy($id)
    {
        $owner = owner::find($id);
        //$owner->delete();
        $owner->update(['is_delet'=>'1']);
        return redirect()->route('master.owner.index')->with('success', 'Data has been delete.');
    }
}
