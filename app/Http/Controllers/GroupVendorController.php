<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupVendor;
use App\Departemen;

class GroupVendorController extends Controller
{
    public function index()
    {
        return view('groupvendor.create')->with(['datas'=>Departemen::all(), 'gvs'=>GroupVendor::paginate(4)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_vendor' => ['required'],
           
        ]);

        GroupVendor::create($request->all());
        return redirect()->route('master.groupvendor.index')->with('success', 'Data has been created.');

    }

    public function edit($id)
    {
        
        return view('groupvendor.edit')->with(['datas'=>Departemen::all(), 'gvs'=>GroupVendor::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $gv = GroupVendor::find($id);

        $request->validate([
            'type_vendor' => ['required'],
        ]);

        $gv->update($request->all());
        return redirect()->route('master.groupvendor.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $gv = GroupVendor::find($id);
        $gv->delete();
        return redirect()->route('master.groupvendor.index')->with('success', 'Data has been delete.');
    }
}
