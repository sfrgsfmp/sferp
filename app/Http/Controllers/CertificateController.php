<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\certificate;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        return view('certificate.create')->with(['datas'=>Departemen::all(), 'cert'=>certificate::where('is_delete', '0')->paginate(5)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cert_code' => ['required'],
            'cert_name' => ['required'],
        ]);

        if (certificate::where('cert_code', $request->get('cert_code'))->exists()) {
            // exists
            return redirect()->route('master.certificate.index')->with('warning', 'Code already exists.');
        }else{
            certificate::create($request->all());
            return redirect()->route('master.certificate.index')->with('success', 'Data has been created.');
        }

        //certificate::create($request->all());
        //return redirect()->route('master.certificate.index')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        
        return view('certificate.edit')->with(['datas'=>Departemen::all(), 'cert'=>certificate::find($id)]);
        
    }

    public function update(Request $request, $id)
    {
        $certificate = certificate::find($id);

        $request->validate([
            'cert_code' => ['required'],
            'cert_name' => ['required'],
        ]);

            $certificate->update($request->all());
            return redirect()->route('master.certificate.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $certificate = certificate::find($id);
        //$certificate->delete();
        $certificate->update(['is_delete'=> '1']);
        return redirect()->route('master.certificate.index')->with('success', 'Data has been delete.');
    }
}
