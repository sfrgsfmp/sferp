<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\quality;

class QualityController extends Controller
{
    public function index()
    {
        return view('quality.create')->with(['datas'=>Departemen::all(), 'qa'=>quality::where('is_delete','0')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quality_code' => ['required'],
            'quality_name' => ['required'],
            'quality_legend' => ['required'],
            'quality_type' => [''],
        ]);

        if (quality::where('quality_code', $request->get('quality_code'))->exists()) {
            // exists
            return redirect()->route('master.quality.index')->with('warning', 'Code already exists.');
        }else{
            quality::create($request->all());
            return redirect()->route('master.quality.index')->with('success', 'Data has been created.');
        }

        //quality::create($request->all());
        //return redirect()->route('master.quality.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('quality.edit')->with(['datas'=>Departemen::all(), 'qa'=>quality::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $quality = quality::find($id);

        $request->validate([
            'quality_code' => ['required'],
            'quality_name' => ['required'],
            'quality_legend' => ['required'],
            'quality_type' => [''],
        ]);

        $quality->update($request->all());
        return redirect()->route('master.quality.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $quality = quality::find($id);
        //$quality->delete();
        $quality->update(['is_delete'=>'1']);
        return redirect()->route('master.quality.index')->with('success', 'Data has been delete.');
    }
}
