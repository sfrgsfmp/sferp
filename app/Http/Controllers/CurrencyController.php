<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\currency;

class CurrencyController extends Controller
{
    //
    public function index()
 {
     return view('currency.create')->with(['datas'=>Departemen::all(), 'cry'=>currency::where('is_delete','0')->paginate(5)]);
 }

 public function store(Request $request)
 {
     $request->validate([
         'code' => ['required'],
         'name' => ['required'],
     ]);

     if (currency::where('code', $request->get('code'))->exists()) {
         // exists
         return redirect()->route('master.currency.index')->with('warning', 'Code already exists.');
     }else{
         currency::create($request->all());
         return redirect()->route('master.currency.index')->with('success', 'Data has been created.');
     }

     //currency::create($request->all());
     //return redirect()->route('master.currency.index')->with('success', 'Data has been created.');
 }

 public function edit($id)
 {
     
     return view('currency.edit')->with(['datas'=>Departemen::all(), 'cry'=>currency::find($id)]);
     
 }

 public function update(Request $request, $id)
 {
     $currency = currency::find($id);

     $request->validate([
         'code' => ['required'],
         'name' => ['required'],
     ]);

        $currency->update($request->all());
        return redirect()->route('master.currency.index')->with('success', 'Data has been updated.');

 }

 public function destroy($id)
 {
     $currency = currency::find($id);
     //$currency->delete();
     $currency->update(['is_delete'=>'1']);
     return redirect()->route('master.currency.index')->with('success', 'Data has been delete.');
 }
}
