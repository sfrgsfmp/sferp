<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Ipl;
use App\Vendor;
use App\Species;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailReqIPL;


class IplController extends Controller
{
    public function index()
    {
       
        $ipl = Ipl::all();
       
        
        if(! $ipl->isEmpty()) //check
        {
            // $hasil = 'ada';
            $hsl = Ipl::get()->last()->noipl;
            $hsl2 = Str::substr($hsl, 0, 4);
            $hsl3 = $hsl2+1;
            $hsl4 = str_pad($hsl3,4,'0',STR_PAD_LEFT);
            $code = $hsl4.'/'.date('m').'/'.date('Y').'/IPL/SFMP';
        }
        else
        {
            // $code = 'empty';
            $hsl = '1';
            $hsl2 = str_pad($hsl,4,'0',STR_PAD_LEFT);
            $code = $hsl2.'/'.date('m').'/'.date('Y').'/IPL/SFMP';
        }
        // echo $code;
        
        $datas = Departemen::all();
       
        return view ('ipl.create')->with(['code' => $code, 'datas'=> $datas, 'vendors'=>Vendor::all()]);
    }

    public function getCodeIPL()
    {   
       
        $ipl = Ipl::all();
        // $ipl->count();
        
        if(! $ipl->isEmpty()) //check
        {
            // $code = 'ada';
            $hsl = Ipl::get()->last()->noipl;
            // $code = Ipl::get()->last()->noipl;
            $hsl2 = Str::substr($hsl, 0, 4);
            $hsl3 = $hsl2+1;
            $hsl4 = str_pad($hsl3,4,'0',STR_PAD_LEFT);
            $code = $hsl4.'/'.date('m').'/'.date('Y').'/IPL/SFMP';
        }
        else
        {
            // $code = 'empty';
            $hsl = '1';
            $hsl2 = str_pad($hsl,4,'0',STR_PAD_LEFT);
            $code = $hsl2.'/'.date('m').'/'.date('Y').'/IPL/SFMP';
        }
        // echo $code;
        
        $datas = Departemen::all();
        
        return view ('ipl.create')->with(['code' => $code, 'datas'=> $datas, 'vendors'=>Vendor::all(), 'species'=>Species::all(), 'users'=>User::all()]);

        
    }

    public function store(Request $request)
    {

        $get_vendor = $request->vendor_id; //id,typevendor
        $get = explode(',',$get_vendor);
        $get_idvendor = $get[0];
        $get_typevendor = $get[1];

        if(($request->sortimen == 'LOG') && ($get_typevendor == 'Perhutani'))
        {
            
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'diameter_from' => ['required'],
                'diameter_to' => ['required'],
                'uom_diameter' => ['required'],
                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],

                'status' => ['required'],
                'quality' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

           
        }

        elseif(($request->sortimen == 'LOG') && ($get_typevendor == 'NonPerhutani' ))
        {
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'diameter_from' => ['required'],
                'diameter_to' => ['required'],
                'uom_diameter' => ['required'],
                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],

                'kwt' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

           
        }

        elseif(($request->sortimen != 'LOG') && ($get_typevendor == 'Perhutani' ))
        {
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],
                'width_from' => ['required'],
                'width_to' => ['required'],
                'uom_width' => ['required'],
                'thick_from' => ['required'],
                'thick_to' => ['required'],
                'uom_thick' => ['required'],

                'status' => ['required'],
                'quality' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

    
        }

        // // if($request->sortimen != 'LOG' && $get_typevendor == 'NonPerhutani' )
        else
        {
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],
                'width_from' => ['required'],
                'width_to' => ['required'],
                'uom_width' => ['required'],
                'thick_from' => ['required'],
                'thick_to' => ['required'],
                'uom_thick' => ['required'],

                'kwt' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

        }
        
        // dd($get_idvendor);
        
        // Ipl::create($request->all());
        

        $ipl = new Ipl();
        $ipl->noipl = $request->get('noipl');
        $ipl->transaction_date  = $request->get('transaction_date');
        $ipl->vendor_id = $get_idvendor;
        $ipl->species_id = $request->get('species_id');
        $ipl->sortimen  = $request->get('sortimen');
        $ipl->diameter_from  = $request->get('diameter_from');
        $ipl->diameter_to  = $request->get('diameter_to');
        $ipl->uom_diameter  = $request->get('uom_diameter');
        $ipl->length_from = $request->get('length_from');
        $ipl->length_to = $request->get('length_to');
        $ipl->uom_length  = $request->get('uom_length');
        $ipl->width_from  = $request->get('width_from');
        $ipl->width_to = $request->get('width_to');
        $ipl->uom_width  = $request->get('uom_width');
        $ipl->thick_from  = $request->get('thick_from');
        $ipl->thick_to  = $request->get('thick_to');
        $ipl->uom_thick = $request->get('uom_thick');

        $ipl->status  = $request->get('status');
        $ipl->quality  = $request->get('quality');
        $ipl->kwt  = $request->get('kwt');
        $ipl->wood_drying = $request->get('wood_drying');
        $ipl->schema  = $request->get('schema');
        $ipl->volume = $request->get('volume');
        $ipl->uom_volume  = $request->get('uom_volume');

        $ipl->approvalto_id = $request->get('approvalto_id');
        $ipl->status_approval = '1';
        $ipl->createdby_id = Auth::user()->id;
        $ipl->save();
        
        return redirect()->route('ipl.show')->with('success', 'IPL has been created.');
        // dd($request->all());
        // dd($ipl);
        
    }

    public function show()
    {
        $datas = Departemen::all();
        return view('ipl.show')->with(['datas'=> $datas, 'ipls'=>Ipl::all()]);
    }

    public function destroy($id)
    {
        $ipl = Ipl::find($id);
        $ipl->delete();
        return redirect()->route('ipl.show')->with('success', 'Data has been delete.');
    }

    public function edit($id)
    {
        $datas = Departemen::all();   
        return view('ipl.edit')->with(['datas'=> $datas, 'ipls'=>Ipl::find($id), 'vendors'=>Vendor::all(), 'species'=>Species::all(), 'users'=>User::all()]);
        
    }

    public function update(Request $request, $id)
    {
        $ipl = Ipl::find($id);

        $get_vendor = $request->vendor_id; //id,typevendor
        $get = explode(',',$get_vendor);
        $get_idvendor = $get[0];
        $get_typevendor = $get[1];

        if(($request->sortimen == 'LOG') && ($get_typevendor == 'Perhutani'))
        {
            
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'diameter_from' => ['required'],
                'diameter_to' => ['required'],
                'uom_diameter' => ['required'],
                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],

                'status' => ['required'],
                'quality' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

           
        }

        elseif(($request->sortimen == 'LOG') && ($get_typevendor == 'NonPerhutani' ))
        {
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'diameter_from' => ['required'],
                'diameter_to' => ['required'],
                'uom_diameter' => ['required'],
                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],

                'kwt' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

           
        }

        elseif(($request->sortimen != 'LOG') && ($get_typevendor == 'Perhutani' ))
        {
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],
                'width_from' => ['required'],
                'width_to' => ['required'],
                'uom_width' => ['required'],
                'thick_from' => ['required'],
                'thick_to' => ['required'],
                'uom_thick' => ['required'],

                'status' => ['required'],
                'quality' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

    
        }

        // // if($request->sortimen != 'LOG' && $get_typevendor == 'NonPerhutani' )
        else
        {
            $request->validate([
                'noipl' => ['required'],
                'transaction_date' => ['required'],
                'vendor_id' => ['required'],
                'species_id' => ['required'],
                'sortimen' => ['required'],

                'length_from' => ['required'],
                'length_to' => ['required'],
                'uom_length' => ['required'],
                'width_from' => ['required'],
                'width_to' => ['required'],
                'uom_width' => ['required'],
                'thick_from' => ['required'],
                'thick_to' => ['required'],
                'uom_thick' => ['required'],

                'kwt' => ['required'],

                'wood_drying' => ['required'],
                'schema' => ['required'],
                'volume' => ['required'],
                'uom_volume' => ['required'],
                'approvalto_id' => ['required'],
            ]);

        }

        $ipl = Ipl::find($id);
        $ipl->noipl = $request->get('noipl');
        $ipl->transaction_date  = $request->get('transaction_date');
        $ipl->vendor_id = $get_idvendor;
        $ipl->species_id = $request->get('species_id');
        $ipl->sortimen  = $request->get('sortimen');
        $ipl->diameter_from  = $request->get('diameter_from');
        $ipl->diameter_to  = $request->get('diameter_to');
        $ipl->uom_diameter  = $request->get('uom_diameter');
        $ipl->length_from = $request->get('length_from');
        $ipl->length_to = $request->get('length_to');
        $ipl->uom_length  = $request->get('uom_length');
        $ipl->width_from  = $request->get('width_from');
        $ipl->width_to = $request->get('width_to');
        $ipl->uom_width  = $request->get('uom_width');
        $ipl->thick_from  = $request->get('thick_from');
        $ipl->thick_to  = $request->get('thick_to');
        $ipl->uom_thick = $request->get('uom_thick');

        $ipl->status  = $request->get('status');
        $ipl->quality  = $request->get('quality');
        $ipl->kwt  = $request->get('kwt');
        $ipl->wood_drying = $request->get('wood_drying');
        $ipl->schema  = $request->get('schema');
        $ipl->volume = $request->get('volume');
        $ipl->uom_volume  = $request->get('uom_volume');

        $ipl->approvalto_id = $request->get('approvalto_id');
        $ipl->status_approval = '1';
        $ipl->createdby_id = Auth::user()->id;
        $ipl->save();

        return redirect()->route('ipl.show')->with('success', 'Data has been updated.');

    }

    public function send($id)
    {
        $ipl = Ipl::find($id);
        $approvalto = $ipl->approvalto_id;

        $user = User::find($approvalto);
        $email_approval = $user->email;
     
        $ipl->update([
            'status_approval'=>'2', //2 waiting approval
            'send_approval'=>'2' //2 = done send email
            
        ]);

        Mail::to($email_approval)->send(new MailReqIPL($ipl));
        return back()->with('success', 'Message has been sent');

    }

    public function approve($id)
    {
        //1=Created, 2=WaitingApproval 3=Approved, 4=Rejected, 5=Revisi
        $ipl = Ipl::find($id);
        $ipl->update([
            'status_approval'=>'3', //3 Approved
        ]);
        return back()->with('success', 'Request has been approved.');
    }

    public function reject($id)
    {
        $ipl = Ipl::find($id);
        $ipl->update([
            'status_approval'=>'4' //4 Rejected
        ]);
        return back()->with('success', 'Request has been rejected.');
    }

    public function revise($id)
    {
        $ipl = Ipl::find($id);
        $ipl->update([
            'status_approval'=>'5' //4 Rejected
        ]);
        return back()->with('success', 'Request has been revision.');
    }
}
