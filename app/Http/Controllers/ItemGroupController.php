<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\itemgroup;

class ItemGroupController extends Controller
{
    public function index()
    {
        return view('itemgroup.create')->with(['datas'=>Departemen::all(), 'igroup'=>itemgroup::where('is_delete', '0')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'itemgroup_code' => ['required'],
            'itemgroup_name' => ['required'],
           
        ]);

        if (itemgroup::where('itemgroup_code', $request->get('itemgroup_code'))->exists()) {
            // exists
            return redirect()->route('master.itemgroup.index')->with('warning', 'Code already exists.');
        }else{
            itemgroup::create($request->all());
            return redirect()->route('master.itemgroup.index')->with('success', 'Data has been created.');
        }

        //itemgroup::create($request->all());
        //return redirect()->route('master.itemgroup.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('itemgroup.edit')->with(['datas'=>Departemen::all(), 'igroup'=>itemgroup::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $itemgroup = itemgroup::find($id);

        $request->validate([
            'itemgroup_code' => ['required'],
            'itemgroup_name' => ['required'],
        ]);

        $itemgroup->update($request->all());
        return redirect()->route('master.itemgroup.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $itemgroup = itemgroup::find($id);
        // $itemgroup->delete();
        $itemgroup->update(['is_delete'=> '1']);
        return redirect()->route('master.itemgroup.index')->with('success', 'Data has been delete.');
    }
}
