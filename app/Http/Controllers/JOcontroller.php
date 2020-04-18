<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Company;
use App\ItemGroup;
use App\Objective;
use App\PIM;
use App\Vendor;
use App\PO;
use App\Specification;
use App\Certificate;
use App\vehicle;
use App\Warehouse;
use App\Quality;
use App\PO_detail;
use App\Species;
use App\JO;
use App\TPK;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\DB;

class JOcontroller extends Controller
{
    public function create()
    {
        return view('joborder.create')->with(['datas'=>Departemen::all(), 'company'=>Company::all(), 'itemgroup'=>ItemGroup::all(), 'objective'=>Objective::all(), 'pims'=>PIM::where('is_delete','0')->get(), 'warehouse'=>Warehouse::where('is_delete','0')->get(), 'quality'=>Quality::where('is_delete', '0')->get(), 'jos'=>JO::where(['is_delete'=>'0'])->get() ]);
    }

    public function selectpim($id)
    {
        $codepim = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code_pim');
        $pimno = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('pimno');
        $vendorid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('vendor_id');
        $vendorname = Vendor::where(['id'=>$vendorid])->pluck('name_vendor');
        $tpk_id = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('tpk_id');
        $tpk = TPK::where('id',$tpk_id)->pluck('name_tpk');

        $sortimen = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('sortimen');
        $po_id = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('po_reference');
        $po = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('code');
        $spec = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('spec_id');
        $spec_name = Specification::where(['id'=>$spec])->pluck('name');

        $certificate_id = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('certificate');
        $certificate_name = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('cert_name');
        $kode_fsc = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('kode_fsc');

        $typetransportid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('type_transport_id');
        $typetransport = vehicle::where(['id'=>$typetransportid, 'is_delete'=>'0'])->pluck('vehicle_name');
        $notransport = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('notransport');
        $date = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('date');

        $parcel = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('noparcel');
        $estdoc = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('estdocm3');
        $species = PO_detail::where(['code_po'=>$po, 'is_delete'=>'0'])->pluck('species_id');
        $speciesname = Species::where('id',$species)->pluck('name');
        $measurement = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('measurement');
        $document = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('document');
        $contractorid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('contractor_id');
        $contractor = Vendor::where(['id'=>$contractorid])->pluck('name_vendor');

        return json_encode(array($codepim, $pimno, $vendorname, $po,$spec_name,$sortimen, $certificate_name, $kode_fsc, $typetransport, $notransport, $date, $parcel, $estdoc, $speciesname, $measurement, $document, $contractor, $id, $tpk));
    }


    public function store(Request $request)
    {
        $request->validate([
            // 'jo' => ['required'],
            'applydate' => ['required'],
            'division' => ['required'],
            'itemgroup_id' => ['required'],
            // 'objective' => ['required'],
            'pimid' => ['required'],
            'pim_code' => ['required'],
            'estdocm3' => ['required'],
            
            'tuk' => ['required'],
            'identitas' => ['required'],
            // 'instruksilain' => ['required'],
        ]);
        
        //FORMAT JO
        $itemgroup = $request->get('itemgroup');
        $division = $request->get('division');
        $month = date('m');
        $year = date('Y');
        $yr = Str::substr($year, 2, 2);
        
        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        // // $cekthn=substr($rp->nomor_kavling,0,2);
        // if($yr != $cekthn)
        // {
        //     $i=1;
        // }
        // else
        // {
        //     $i++;    
        // }
        
        $j = JO::all();
        if(! $j->isEmpty()) //check
        {
            //ada
            $code = JO::get()->last()->code_jo;
            $cp = Str::substr($code, -4);
            $cpi = $cp+1;
            $cjo = str_pad($cpi,4,'0',STR_PAD_LEFT); 
            $codejo = 'JO/'.$itemgroup.'/'.$division.'/'.$month.$yr.'/'.$cjo;

            //untuk Nomor JO
            $nojo = JO::get()->last()->jo;
            $cekthn = Str::substr($nojo, 0, 2);

            if($yr != $cekthn)
            {
                $i=1;
            }
            else
            {
                $i++;    
            }
            // $i = 1;
            
            $counter = str_pad($i,5,'0',STR_PAD_LEFT); 
            $no_jo = $yr."".$counter;

        }
        else
        {
            //kosong
            // JO/ITEMGROUP/DIVISION/blnTHN/URUTAN
            $codejo = 'JO/'.$itemgroup.'/'.$division.'/'.$month.$yr.'/'.$urutan;

           
            $i=1;
            
            $counter = str_pad($i,5,'0',STR_PAD_LEFT); 
            $no_jo = $yr."".$counter;
        }



        $p = new JO();
        $p->code_jo = $codejo;
        // $p->jo = $request->get('jo');
        $p->jo = $no_jo;
        
        $p->applydate= $request->get('applydate');
        $p->division = $request->get('division');
        $p->itemgroup_id = $request->get('itemgroup_id');
        // $p->objective = $request->get('objective');
        $p->pimid = $request->get('pimid');
        $p->estdocm3 = $request->get('estdocm3');
        $p->tuk = $request->get('tuk');
        $p->whgrade = $request->get('whgrade');
        $p->whsimpan = $request->get('whsimpan');
        $p->whtahan = $request->get('whtahan');
        $p->instruksilain = $request->get('instruksilain');
        $p->identitas = $request->get('identitas');
        $p->tebalfisik = $request->get('tebalfisik');
        $p->lebarfisik = $request->get('lebarfisik');
        $p->panjangfisik = $request->get('panjangfisik');
        $p->descfisik = $request->get('descfisik');
        $p->tebalbeli = $request->get('tebalbeli');
        $p->lebarbeli = $request->get('lebarbeli');
        $p->panjangbeli = $request->get('panjangbeli');
        $p->descbeli = $request->get('descbeli');
        $p->tebalinvoice = $request->get('tebalinvoice');
        $p->lebarinvoice = $request->get('lebarinvoice');
        $p->panjanginvoice = $request->get('panjanginvoice');
        $p->descinvoice = $request->get('descinvoice');
        $p->seratmiring = $request->get('seratmiring');
        $p->seratputus = $request->get('seratputus');
        $p->bengkoklebar = $request->get('bengkoklebar');
        $p->bengkoktebal = $request->get('bengkoktebal');
        $p->gelombanglebar = $request->get('gelombanglebar');
        $p->gelombangtebal = $request->get('gelombangtebal');
        $p->twist = $request->get('twist');
        $p->warnagelap = $request->get('warnagelap');
        $p->stain = $request->get('stain');
        $p->taliair = $request->get('taliair');
        $p->busuk = $request->get('busuk');
        $p->pecahpermukaan = $request->get('pecahpermukaan');
        $p->pecahujung = $request->get('pecahujung');
        $p->retak = $request->get('retak');
        $p->matamati = $request->get('matamati');
        $p->kulittumbuh = $request->get('kulittumbuh');
        $p->pinholes = $request->get('pinholes');
        $p->doreng = $request->get('doreng');
        $p->warnaterang = $request->get('warnaterang');
        $p->kayumuda = $request->get('kayumuda');
        $p->kukumacan = $request->get('kukumacan');
        $p->sisibaik = $request->get('sisibaik');
        $p->h2b = $request->get('2b');
        $p->h2k = $request->get('2k');
        $p->gubalsisiorder = $request->get('gubalsisiorder');
        $p->gubalsisinonorder = $request->get('gubalsisinonorder');
        $p->cacatring = $request->get('cacatring');
        $p->kualitas = $request->get('kualitas');
        $p->save();

        return redirect()->back()->with('success', 'Data has been created');
    }

    public function edit($id)
    {
        $pimid = JO::where(['id'=>$id, 'is_delete'=>'0'])->pluck('pimid');
        $pimcode = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('code_pim');
        $pimno = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('pimno');
        $po_reference = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('po_reference');
        $po = PO::where(['id'=>$po_reference, 'is_delete'=>'0'])->pluck('code');
        $vendorid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('vendor_id');
        $vendor = Vendor::where('id', $vendorid)->pluck('name_vendor');
        $tpk_id = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('tpk_id');
        $tpk = TPK::where('id',$tpk_id)->pluck('name_tpk');

        
        $spec = PO::where(['id'=>$po_reference, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('spec_id');
        $specname = Specification::where(['id'=>$spec])->pluck('name');
        $sortimen = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('sortimen');
        $certificate_id = PO::where(['id'=>$po_reference, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('certificate');
        $certificate_name = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('cert_name');
        $kode_fsc = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('kode_fsc');

        $typetransportid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('type_transport_id');
        $typetransport = vehicle::where(['id'=>$typetransportid, 'is_delete'=>'0'])->pluck('vehicle_name');
        $notransport = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('notransport');
        $date = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('date');
        
        $parcel = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('noparcel');

        $poss = PO::where(['id'=>$po_reference, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('code');
        $species = PO_detail::where(['code_po'=>$poss, 'is_delete'=>'0'])->pluck('species_id');
        $speciesname = Species::where('id',$species)->pluck('name');

        $measurement = PO::where(['id'=>$po_reference, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('measurement');
        $document = PO::where(['id'=>$po_reference, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('document');

        $contractorid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('contractor_id');
        $contractor = Vendor::where(['id'=>$contractorid])->pluck('name_vendor');

        return view('joborder.edit')
        ->with(['datas'=>Departemen::all(),'j'=>JO::find($id), 'jos'=>JO::where(['is_delete'=>'0'])->get(), 'pims'=>PIM::where('is_delete','0')->get(), 'objective'=>Objective::all(), 'company'=>Company::all(), 'itemgroup'=>ItemGroup::all(), 'warehouse'=>Warehouse::where('is_delete','0')->get(), 'quality'=>Quality::where('is_delete', '0')->get(), 'po'=>$po[0], 'vendor'=>$vendor, 'tpk'=>$tpk, 'specname'=>$specname, 'sortimen'=>$sortimen, 'certificate_name'=>$certificate_name[0], 'kode_fsc'=>$kode_fsc, 'typetransport'=>$typetransport, 'notransport'=>$notransport, 'date'=>$date, 'parcel'=>$parcel, 'speciesname'=>$speciesname, 'measurement'=>$measurement[0], 'document'=>$document[0], 'contractor'=>$contractor  ])
        ->with('pimcode',$pimcode)
        ->with('pimno',$pimno);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'applydate' => ['required'],
            // 'division' => ['required'],
            // 'itemgroup_id' => ['required'],
            // 'objective' => ['required'],
            'pimid' => ['required'],
            'pim_code' => ['required'],
            'estdocm3' => ['required'],
            
            'tuk' => ['required'],
            'identitas' => ['required'],
            'instruksilain' => ['required'],
        ]);
        
        $p = JO::find($id);
        $p->code_jo = $request->get('code_jo');
        $p->jo = $request->get('jo');
        
        
        $p->applydate= $request->get('applydate');
        $p->division = $request->get('division');
        $p->itemgroup_id = $request->get('itemgroup_id');
        
        // $p->objective = $request->get('objective');
        $p->pimid = $request->get('pimid');
        $p->estdocm3 = $request->get('estdocm3');
        $p->tuk = $request->get('tuk');
        $p->whgrade = $request->get('whgrade');
        $p->whsimpan = $request->get('whsimpan');
        $p->whtahan = $request->get('whtahan');
        $p->instruksilain = $request->get('instruksilain');
        $p->identitas = $request->get('identitas');
        $p->tebalfisik = $request->get('tebalfisik');
        $p->lebarfisik = $request->get('lebarfisik');
        $p->panjangfisik = $request->get('panjangfisik');
        $p->descfisik = $request->get('descfisik');
        $p->tebalbeli = $request->get('tebalbeli');
        $p->lebarbeli = $request->get('lebarbeli');
        $p->panjangbeli = $request->get('panjangbeli');
        $p->descbeli = $request->get('descbeli');
        $p->tebalinvoice = $request->get('tebalinvoice');
        $p->lebarinvoice = $request->get('lebarinvoice');
        $p->panjanginvoice = $request->get('panjanginvoice');
        $p->descinvoice = $request->get('descinvoice');
        $p->seratmiring = $request->get('seratmiring');
        $p->seratputus = $request->get('seratputus');
        $p->bengkoklebar = $request->get('bengkoklebar');
        $p->bengkoktebal = $request->get('bengkoktebal');
        $p->gelombanglebar = $request->get('gelombanglebar');
        $p->gelombangtebal = $request->get('gelombangtebal');
        $p->twist = $request->get('twist');
        $p->warnagelap = $request->get('warnagelap');
        $p->stain = $request->get('stain');
        $p->taliair = $request->get('taliair');
        $p->busuk = $request->get('busuk');
        $p->pecahpermukaan = $request->get('pecahpermukaan');
        $p->pecahujung = $request->get('pecahujung');
        $p->retak = $request->get('retak');
        $p->matamati = $request->get('matamati');
        $p->kulittumbuh = $request->get('kulittumbuh');
        $p->pinholes = $request->get('pinholes');
        $p->doreng = $request->get('doreng');
        $p->warnaterang = $request->get('warnaterang');
        $p->kayumuda = $request->get('kayumuda');
        $p->kukumacan = $request->get('kukumacan');
        $p->sisibaik = $request->get('sisibaik');
        $p->h2b = $request->get('2b');
        $p->h2k = $request->get('2k');
        $p->gubalsisiorder = $request->get('gubalsisiorder');
        $p->gubalsisinonorder = $request->get('gubalsisinonorder');
        $p->cacatring = $request->get('cacatring');
        $p->kualitas = $request->get('kualitas');
        $p->save();

        return redirect()->back()->with('success', 'Data has been updated');
    }

    public function delete($id)
    {
        $j = JO::find($id);
        $j->update(['is_delete'=> '1']);
        return back()->with('success', 'Data has been delete.');
    }

    public function report($id)
    {
        $jo = DB::table('joborder')
            ->leftJoin('pim','joborder.pimid','=','pim.id')
            ->leftJoin('tpk', 'pim.tpk_id','=','tpk.id')
            ->leftJoin('vendor', 'pim.vendor_id','=','vendor.id')
            ->leftJoin('vendor as c', 'pim.contractor_id','=','c.id')
            ->leftJoin('po_transaction','pim.po_reference','=','po_transaction.id')
            ->leftJoin('certificate', 'po_transaction.certificate', '=','certificate.id')
            ->leftJoin('vehicle','pim.type_transport_id','=','vehicle.id')
            ->leftJoin('species','po_transaction.speciess','=','species.id')
            ->leftJoin('warehouse as whg','joborder.whgrade','=','whg.id')
            ->leftJoin('warehouse as whs','joborder.whsimpan','=','whs.id')
            ->leftJoin('warehouse as wht','joborder.whtahan','=','wht.id')
            ->leftJoin('quality as d','joborder.seratmiring','=','d.id')
            ->leftJoin('quality as e','joborder.seratputus','=','e.id')
            ->leftJoin('quality as f','joborder.bengkoklebar','=','f.id')
            ->leftJoin('quality as g','joborder.bengkoktebal','=','g.id')
            ->leftJoin('quality as h','joborder.gelombanglebar','=','h.id')
            ->leftJoin('quality as i','joborder.gelombangtebal','=','i.id')
            ->leftJoin('quality as j','joborder.twist','=','j.id')
            ->leftJoin('quality as k','joborder.warnagelap','=','k.id')
            ->leftJoin('quality as l','joborder.stain','=','l.id')
            ->leftJoin('quality as m','joborder.taliair','=','m.id')
            ->leftJoin('quality as n','joborder.busuk','=','n.id')
            ->leftJoin('quality as o','joborder.pecahpermukaan','=','o.id')
            ->leftJoin('quality as p','joborder.pecahujung','=','p.id')
            ->leftJoin('quality as q','joborder.retak','=','q.id')
            ->leftJoin('quality as r','joborder.matamati','=','r.id')
            ->leftJoin('quality as s','joborder.kulittumbuh','=','s.id')
            ->leftJoin('quality as t','joborder.pinholes','=','t.id')
            ->leftJoin('quality as u','joborder.doreng','=','u.id')
            ->leftJoin('quality as v','joborder.warnaterang','=','v.id')
            ->leftJoin('quality as w','joborder.kayumuda','=','w.id')
            ->leftJoin('quality as x','joborder.kukumacan','=','x.id')
            ->leftJoin('quality as y','joborder.sisibaik','=','y.id')
            ->leftJoin('quality as z','joborder.h2b','=','z.id')

            ->select('joborder.*','pim.noparcel','pim.sortimen','species.code as speciesname','tpk.name_tpk','vendor.name_vendor','certificate.cert_code', 'certificate.kode_fsc','vehicle.vehicle_code','pim.notransport', 'pim.date','po_transaction.document','po_transaction.measurement','po_transaction.qualitynote','c.name_vendor as contractor','whg.warehouse_code as whgrader','whs.warehouse_code as whsimpan', 'wht.warehouse_code as whtahan','po_transaction.spec_id','d.quality_code as seratmiring','e.quality_code as seratputus','f.quality_code as bengkoklebar','g.quality_code as bengkoktebal', 'h.quality_code as gelebar','i.quality_code as geltebal','j.quality_code as twist','k.quality_code as wglp','l.quality_code as stain','m.quality_code as taliair','n.quality_code as bsk','o.quality_code as pecahp','p.quality_code as pecahu')
            ->where([
                ['joborder.id','=',$id],
                ['joborder.is_delete','=','0']
            ])
            ->get();

        
        if($jo[0]->sortimen == 'log' || $jo[0]->sortimen == 'LOG')
        {
            $pdf = PDF::loadView('joborder.report', compact('jo'));
            return $pdf->stream('Report JO -'.$id.'.pdf');
        }
        else
        {
            $pdf = PDF::loadView('joborder.report_jo_st', compact('jo'));
            return $pdf->stream('Report JO -'.$id.'.pdf');
        }
        
    }
}
