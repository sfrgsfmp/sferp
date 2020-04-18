<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\section;

class SectionController extends Controller
{
    //
    public function index()
 {
     return view('section.create')->with(['datas'=>Departemen::all(), 'seksinya'=>section::where('is_delete','0')->paginate(5)]);
 }
 
 public function store(Request $request)
 {
     $request->validate([
         'code' => ['required'],
         'name' => ['required'],
     ]);

     if (section::where('code', $request->get('code'))->exists()) {
         // exists
         return redirect()->route('master.section.index')->with('warning', 'Code already exists.');
     }else{
         section::create($request->all());
         return redirect()->route('master.section.index')->with('success', 'Data has been created.');
     }

     //section::create($request->all());
     //return redirect()->route('master.section.index')->with('success', 'Data has been created.');
 }

 public function edit($id)
 {
     
     return view('section.edit')->with(['datas'=>Departemen::all(), 'seksinya'=>section::find($id)]);
     
 }

 public function update(Request $request, $id)
 {
     $section = section::find($id);

     $request->validate([
         'code' => ['required'],
         'name' => ['required'],
     ]);

        $section->update($request->all());
        return redirect()->route('master.section.index')->with('success', 'Data has been updated.');

 }

 public function destroy($id)
 {
     $section = section::find($id);
     //$section->delete();
     $section->update(['is_delete'=>'1']);
     return redirect()->route('master.section.index')->with('success', 'Data has been delete.');
 }
}
