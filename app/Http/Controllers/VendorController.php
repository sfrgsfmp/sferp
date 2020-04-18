<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupVendor;
use App\Departemen;
use App\Vendor;
use App\KPH;
use Indonesia;
use App\IndProv;
use App\IndCity;
use App\BankAccount;
use Illuminate\Support\Facades\DB;


class VendorController extends Controller
{
    public function index()
    {
        return view('vendor.show')->with(['gvs'=>Vendor::all(), 'kphs'=>KPH::all(), 'datas'=>Departemen::all()]);
    }

    public function create()
    {
        // $getprov = $request->province;
        
        return view('vendor.create')->with(['gvs'=>Vendor::all(), 'kphs'=>KPH::all(), 'datas'=>Departemen::all(), 'provinces'=>Indonesia::allProvinces(), 'bankacc'=>BankAccount::all() ]);
    }

    public function getcity($id)
    {
        $get = IndCity::where('province_id', $id)->pluck('name', 'id');
        return json_encode($get);
    }

    

    public function store(Request $request)
    {
        // // dd($request->province);
        // if($request->type_vendor == 'Perhutani')
        // {
        //     $request->validate([
        //         'type_vendor' => ['required'],
        //         'name_vendor' => ['required'],
        //         // 'kph_id' => ['required'],
        //         'email' => ['email'],
        //         'phone' => ['numeric'],
        //     ]);
        // }
        // else
        // {
        //     // $request->kph_id = '';
        //     // $request->except('kph_id');
        //     $request->validate([
        //         'type_vendor' => ['required'],
        //         'name_vendor' => ['required'],
        //         // 'kph_id' => ['nullable'],
        //         'email' => ['email'],
        //         'phone' => ['numeric'],
                
        //     ]);
        //     $request['kph_id'] = null;
        // }

        $request->validate([
            'type_vendor' => ['required'],
            'name_vendor' => ['required'],
            // 'kph_id' => ['nullable'],
            'email' => ['email'],
            'phone' => ['numeric'],
            
        ]);


        $v = new Vendor();
        $v->name_vendor = $request->get('name_vendor');
        $v->address  = $request->get('address');
        $v->province_id = $request->get('province');
        $v->city_id = $request->get('city');
        $v->postalcode  = $request->get('postalcode');
        $v->portofloading  = $request->get('portofloading');
        $v->phone = $request->get('phone');
        $v->fax  = $request->get('fax');
        $v->email = $request->get('email');
        $v->website = $request->get('website');
        $v->bankaccount_id = $request->get('bankaccount_id');
        $v->type_vendor  = $request->get('type_vendor');
        // $v->kph_id  = $request->get('kph_id');
        $v->save();

        
        return redirect()->route('master.vendor.index')->with('success', 'Data has been created.');

    }

    public function edit($id)
    {
        return view('vendor.edit')->with(['datas'=>Departemen::all(), 'kphs'=>KPH::all(), 'gvs'=>Vendor::find($id), 'provs'=>IndProv::all(), 'city'=>IndCity::all(), 'bankacc'=>BankAccount::all() ]);
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'type_vendor' => ['required'],
            'name_vendor' => ['required'],
            // 'kph_id' => ['nullable'],
            'email' => ['email'],
            'phone' => ['numeric'],
            
        ]);

        
        $v = Vendor::find($id);
        $v->name_vendor = $request->get('name_vendor');
        $v->address  = $request->get('address');
        $v->province_id = $request->get('province');
        $v->city_id = $request->get('city');
        $v->postalcode  = $request->get('postalcode');
        $v->portofloading  = $request->get('portofloading');
        $v->phone = $request->get('phone');
        $v->fax  = $request->get('fax');
        $v->email = $request->get('email');
        $v->website = $request->get('website');
        $v->bankaccount_id = $request->get('bankaccount_id');
        $v->type_vendor  = $request->get('type_vendor');
        // $v->kph_id  = $request->get('kph_id');
       

        $v->save();

        return redirect()->route('master.vendor.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $gv = Vendor::find($id);
        $gv->delete();
        return redirect()->route('master.vendor.index')->with('success', 'Data has been delete.');
    }
}
