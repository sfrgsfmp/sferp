<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\PO;
use App\PO_detail;
use App\Vendor;
use App\IndCity;
use App\BankAccount;
use App\KPH;
use App\KBM;
use App\TPK;
use App\Certificate;
use App\Specification;
use Carbon\Carbon;
use App\Warehouse;
use App\Company;
use App\ItemGroup;
use App\Species;
use App\Handling;
use App\vehicle;
use App\PIM;
use Illuminate\Support\Str;
use App\Objective;
use PDF;
use Illuminate\Support\Facades\DB;

class PIMcontroller extends Controller
{
    public function create()
    {
        return view('pim.create')->with(['datas'=>Departemen::all(), 'po'=>PO::where(['is_delete'=>'0', 'status'=>'Approved'])->get(), 'vendors'=>Vendor::all(), 'contractors'=>Vendor::where('type_vendor','NonPerhutani')->get(), 'certificate'=>Certificate::where('is_delete','0')->get(), 'specification'=>Specification::where('type_specification','2')->get(), 'spec'=>Specification::where('type_specification','1')->get(), 'warehouses'=>Warehouse::all(), 'company'=>Company::all(), 'itemgroup'=>ItemGroup::all(), 'species'=>Species::all(), 'handling'=>Handling::where('is_delete','0')->get(), 'vehicle'=>vehicle::where('is_delete','0')->get(), 'pims'=>PIM::where(['is_delete'=>'0'])->get(), 'objective'=>Objective::where('is_delete','0')->get() ]);
    }

    
    public function report($nopim)
    {
        // $pim = PIM::select('*')->where(['is_delete'=>'0','pimno'=>$nopim])->get();
        $pim = DB::table('pim')
            ->leftJoin('po_transaction','pim.po_reference','=','po_transaction.id')
            // ->leftJoin('po_transaction as po', 'species.id','=','po_transaction.speciess')
            ->leftJoin('vehicle','pim.type_transport_id','=','vehicle.id')
            ->leftJoin('species','po_transaction.speciess','=','species.id')
            ->leftJoin('certificate', 'po_transaction.certificate', '=','certificate.id')
            ->leftJoin('tpk','pim.tpk_id','=','tpk.id')
            ->select('pim.*','po_transaction.speciess', 'species.code as speciesname', 'vehicle.vehicle_code', 'tpk.name_tpk', 'certificate.cert_code', 'certificate.kode_fsc')
            ->where([
                ['pim.pimno','=',$nopim],
                ['pim.is_delete','=','0']
            ])
            ->get();

        $pdf = PDF::loadView('pim.report', compact('pim', 'nopim'));
        return $pdf->stream('Report PIM -'.$nopim.'.pdf');
        // return $pdf->download('Report PIM -'.$nopim.'.pdf');
        // dd($id);
    }


    public function get($id)
    {
        $ven = PO::where('id', $id)->pluck('vendor_id');
        
        $speciesid = PO::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code');
        $species_id = PO_detail::where(['code_po'=>$speciesid, 'is_delete'=>'0'])->pluck('species_id');
        $species = Species::where('id', $species_id)->pluck('name');

        $nmvendor = Vendor::where('id', $ven)->pluck('name_vendor');
        $address = Vendor::where('id', $ven)->pluck('address');
        
 
        $c = Vendor::where('id', $ven)->pluck('city_id');
        $city = IndCity::where('id',$c)->pluck('name');
        
        $type_vendor = Vendor::where('id', $ven)->pluck('type_vendor');
        
        $certificate_id = PO::where('id', $id)->pluck('certificate');
        $certificate_name = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('cert_name');
        $kode_fsc = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('kode_fsc');

        $spec_id = PO::where('id', $id)->pluck('spec_id');
        $spec_name = Specification::where('id', $spec_id)->pluck('name');

        return json_encode(array($nmvendor, $address, $city,$ven,$type_vendor, $species, $certificate_name, $kode_fsc, $spec_name));

    }

    public function getKBM($id)
    {
        $id_vendor = PO::where('id',$id)->pluck('vendor_id');
        $provid = Vendor::where('id', $id_vendor)->pluck('province_id');
        $gett = KBM::where('province_id', $provid)->pluck('name_kbm', 'id');
       
        return json_encode($gett);
    }

    public function get_certificate($id)
    {
        $fsc = Certificate::where(['id'=>$id, 'is_delete'=>'0'])->pluck('kode_fsc');
        return json_encode($fsc);
    }


    public function store(Request $request)
    {
        $request->validate([
            // 'code_pim' => ['required'],
            // 'pimno' => ['required'],
            'division' => ['required'],
            'itemgroup_id' => ['required'],
            'applydate' => ['required'],
            'process' => ['required'],
            'objective'=> ['required'],
            'warehouse_id' => ['required'],
            'carasusun' => ['required'],
            // 'soplangkah' => ['required'],
            'po_reference' => ['required'],
            'noprocurement' => ['required'],
            'noparcel'=> ['required'],
            // 'bp'=> ['required'],
            'contractor_id'=> ['required'],
            'informasilain'=> ['required'],
            'note'=> ['required'],
            'type_transport'=> ['required'],
            'notransport'=> ['required'],
            // 'desc'=> ['required'],
            'typem3'=> ['required'],
            'estdocm3'=> ['required'],
            'whbongkar'=> ['required'],
            'whstapel'=> ['required'],
            'starttime'=> ['required'],
            'endtime'=> ['required'],
            'headcount'=> ['required'],
            'date'=> ['required'],
            'spb'=> ['required'],
            'datesupplierpayment'=> ['required'],
            'totalqty'=>['required'],
            'totalm3'=>['required'],
            'totalinvprice'=>['required'],
            // 'desc_sup'=>['required'],
            'workshift'=>['required'],
            'rateused'=>['required'],
            'handling'=>['required'],
            'code_expeditionpayment'=>['required'],
            'paydate_expeditionpayment'=>['required'],
            'price_expeditionpayment'=>['required'],
            'code_freightpayment'=>['required'],
            // 'emkl'=>['required'],
            'paydate_freightpayment'=>['required'],
            'conttype'=>['required'],
            'price_freightpayment'=>['required'],
            'grading_expenses'=>['required'],
            'biayalelang'=>['required'],
            'retribusi'=>['required'],
            'biayalansir'=>['required'],
            'fee'=>['required']
        ]);
        
        //FORMAT PIM
        $itemgroup = $request->get('itemgroup');
        $division = $request->get('division');
        $month = date('m');
        $year = date('Y');
        $yr = Str::substr($year, 2, 2);
        
        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        $pim = PIM::all();
        if(! $pim->isEmpty()) //check
        {
            //ada
            $code = PIM::get()->last()->code_pim;
            $cp = Str::substr($code, -4);
            $cpi = $cp+1;
            $cpim = str_pad($cpi,4,'0',STR_PAD_LEFT); 
            $codepim = 'PIM/'.$itemgroup.'/'.$division.'/'.$month.$yr.'/'.$cpim;

        }
        else
        {
            //kosong
            // PIM/ITEMGROUP/DIVISION/blnTHN/URUTAN
            $codepim = 'PIM/'.$itemgroup.'/'.$division.'/'.$month.$yr.'/'.$urutan;
        }

        $p = new PIM();
        // $p->code_pim = $request->get('code_pim');
        $p->code_pim = $codepim;
        $p->pimno= $request->get('pimno');
        $p->division= $request->get('division');
        $p->itemgroup_id= $request->get('itemgroup_id');
        $p->applydate= $request->get('applydate');
        $p->objective = $request->get('objective');
        $p->process= $request->get('process');
        $p->warehouse_id= $request->get('warehouse_id');
        $p->carasusun= $request->get('carasusun');
        $p->soplangkah= $request->get('soplangkah');
        $p->po_reference= $request->get('po_reference');
        $p->noprocurement= $request->get('noprocurement');
        $p->noparcel= $request->get('noparcel');
        // $p->bp= $request->get('bp');
        $p->vendor_id = $request->get('vendor_id');
        $p->kbm_id = $request->get('kbm_id');
        $p->kph_id = $request->get('kph_id');
        $p->tpk_id = $request->get('tpk_id');
        $p->ftebal= $request->get('ftebal');
        $p->flebar= $request->get('flebar');
        $p->fpanjang= $request->get('fpanjang');
        $p->sortimen= $request->get('sortimen');
        $p->spec2_id= $request->get('spec2_id');
        $p->specs= $request->get('specs');
        $p->contractor_id= $request->get('contractor_id');
        $p->informasilain= $request->get('informasilain');
        $p->note= $request->get('note');
        $p->type_transport_id= $request->get('type_transport');
        $p->notransport= $request->get('notransport');
        $p->desc= $request->get('desc');
        $p->typem3= $request->get('typem3');
        $p->estdocm3= $request->get('estdocm3');
        $p->whbongkar= $request->get('whbongkar');
        $p->whstapel= $request->get('whstapel');
        $p->starttime= $request->get('starttime');
        $p->endtime= $request->get('endtime');
        $p->headcount= $request->get('headcount');
        $p->date= $request->get('date');
        $p->spb= $request->get('spb');
        $p->datesupplierpayment= $request->get('datesupplierpayment');
        $p->totalqty= $request->get('totalqty');
        $p->totalm3= $request->get('totalm3');
        $p->totalinvprice= $request->get('totalinvprice');
        $p->desc_sup= $request->get('desc_sup');
        $p->workshift= $request->get('workshift');
        $p->rateused= $request->get('rateused');
        $p->handling= $request->get('handling');
        $p->code_expeditionpayment= $request->get('code_expeditionpayment');
        $p->paydate_expeditionpayment= $request->get('paydate_expeditionpayment');
        $p->price_expeditionpayment = $request->get('price_expeditionpayment');
        $p->code_freightpayment = $request->get('code_freightpayment');
        $p->emkl = $request->get('emkl');
        $p->paydate_freightpayment = $request->get('paydate_freightpayment');
        $p->conttype = $request->get('conttype');
        $p->price_freightpayment = $request->get('price_freightpayment');
        $p->grading_expenses = $request->get('grading_expenses');
        $p->biayalelang = $request->get('biayalelang');
        $p->retribusi = $request->get('retribusi');
        $p->biayalansir = $request->get('biayalansir');
        $p->fee = $request->get('fee');
        $p->save();

        return redirect()->route('pim.create')->with('success', 'Data has been created');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'code_pim' => ['required'],
            // 'pimno' => ['required'],
            'division' => ['required'],
            'itemgroup_id' => ['required'],
            'applydate' => ['required'],
            'process' => ['required'],
            'objective' => ['required'],
            'warehouse_id' => ['required'],
            'carasusun' => ['required'],
            // 'soplangkah' => ['required'],
            'po_reference' => ['required'],
            'noprocurement' => ['required'],
            'noparcel'=> ['required'],
            // 'bp'=> ['required'],
            'contractor_id'=> ['required'],
            'informasilain'=> ['required'],
            'note'=> ['required'],
            'type_transport'=> ['required'],
            'notransport'=> ['required'],
            // 'desc'=> ['required'],
            'typem3'=> ['required'],
            'estdocm3'=> ['required'],
            'whbongkar'=> ['required'],
            'whstapel'=> ['required'],
            'starttime'=> ['required'],
            'endtime'=> ['required'],
            'headcount'=> ['required'],
            'date'=> ['required'],
            'spb'=> ['required'],
            'datesupplierpayment'=> ['required'],
            'totalqty'=>['required'],
            'totalm3'=>['required'],
            'totalinvprice'=>['required'],
            // 'desc_sup'=>['required'],
            'workshift'=>['required'],
            'rateused'=>['required'],
            'handling'=>['required'],
            'code_expeditionpayment'=>['required'],
            'paydate_expeditionpayment'=>['required'],
            'price_expeditionpayment'=>['required'],
            'code_freightpayment'=>['required'],
            // 'emkl'=>['required'],
            'paydate_freightpayment'=>['required'],
            'conttype'=>['required'],
            'price_freightpayment'=>['required'],
            'grading_expenses'=>['required'],
            'biayalelang'=>['required'],
            'retribusi'=>['required'],
            'biayalansir'=>['required'],
            'fee'=>['required']
        ]);
        
        $p = PIM::find($id);
        $p->code_pim = $request->get('code_pim');
        $p->pimno= $request->get('pimno');
        $p->division= $request->get('division');
        $p->itemgroup_id= $request->get('itemgroup_id');
        $p->applydate= $request->get('applydate');
        $p->objective = $request->get('objective');
        $p->process= $request->get('process');
        $p->warehouse_id= $request->get('warehouse_id');
        $p->carasusun= $request->get('carasusun');
        $p->soplangkah= $request->get('soplangkah');
        $p->po_reference= $request->get('po_reference');
        $p->noprocurement= $request->get('noprocurement');
        $p->noparcel= $request->get('noparcel');
        // $p->bp= $request->get('bp');
        $p->vendor_id = $request->get('vendor_id');
        $p->kbm_id = $request->get('kbm_id');
        $p->kph_id = $request->get('kph_id');
        $p->tpk_id = $request->get('tpk_id');
        $p->ftebal= $request->get('ftebal');
        $p->flebar= $request->get('flebar');
        $p->fpanjang= $request->get('fpanjang');
        $p->sortimen= $request->get('sortimen');
        $p->spec2_id= $request->get('spec2_id');
        $p->specs= $request->get('specs');
        $p->contractor_id= $request->get('contractor_id');
        $p->informasilain= $request->get('informasilain');
        $p->note= $request->get('note');
        $p->type_transport_id= $request->get('type_transport');
        $p->notransport= $request->get('notransport');
        $p->desc= $request->get('desc');
        $p->typem3= $request->get('typem3');
        $p->estdocm3= $request->get('estdocm3');
        $p->whbongkar= $request->get('whbongkar');
        $p->whstapel= $request->get('whstapel');
        $p->starttime= $request->get('starttime');
        $p->endtime= $request->get('endtime');
        $p->headcount= $request->get('headcount');
        $p->date= $request->get('date');
        $p->spb= $request->get('spb');
        $p->datesupplierpayment= $request->get('datesupplierpayment');
        $p->totalqty= $request->get('totalqty');
        $p->totalm3= $request->get('totalm3');
        $p->totalinvprice= $request->get('totalinvprice');
        $p->desc_sup= $request->get('desc_sup');
        $p->workshift= $request->get('workshift');
        $p->rateused= $request->get('rateused');
        $p->handling= $request->get('handling');
        $p->code_expeditionpayment= $request->get('code_expeditionpayment');
        $p->paydate_expeditionpayment= $request->get('paydate_expeditionpayment');
        $p->price_expeditionpayment = $request->get('price_expeditionpayment');
        $p->code_freightpayment = $request->get('code_freightpayment');
        $p->emkl = $request->get('emkl');
        $p->paydate_freightpayment = $request->get('paydate_freightpayment');
        $p->conttype = $request->get('conttype');
        $p->price_freightpayment = $request->get('price_freightpayment');
        $p->grading_expenses = $request->get('grading_expenses');
        $p->biayalelang = $request->get('biayalelang');
        $p->retribusi = $request->get('retribusi');
        $p->biayalansir = $request->get('biayalansir');
        $p->fee = $request->get('fee');
        $p->save();

        return redirect()->back()->with('success', 'Data has been updated');
    }

    public function edit($id)
    {
        $ven = PIM::where('id', $id)->pluck('vendor_id');
        $po = PIM::where('id', $id)->pluck('po_reference');
        $species_id = PO::where('id', $po)->pluck('speciess');
        $nmvendor = Vendor::where('id', $ven)->pluck('name_vendor');
        $address = Vendor::where('id', $ven)->pluck('address');
        $species = Species::where('id', $species_id)->pluck('name');
        $c = Vendor::where('id', $ven)->pluck('city_id');
        $city = IndCity::where('id',$c)->pluck('name');
        $type_vendor = Vendor::where('id', $ven)->pluck('type_vendor');
        $certificate_id = PO::where('id', $po)->pluck('certificate');
        $certificate_name = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('cert_name');
        $kode_fsc = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('kode_fsc');
        $spec_id = PO::where('id', $po)->pluck('spec_id');
        $spec_name = Specification::where('id', $spec_id)->pluck('name');

        return view('pim.edit')->with(['datas'=>Departemen::all(), 'company'=>Company::all(), 'itemgroup'=>ItemGroup::all(), 'warehouses'=>Warehouse::all(), 'po'=>PO::where(['is_delete'=>'0'])->get(), 'vendors'=>Vendor::all(), 'certificate'=>Certificate::where('is_delete','0')->get(), 'spec'=>Specification::where('type_specification','1')->get(), 'specification'=>Specification::where('type_specification','2')->get(), 'contractors'=>Vendor::where('type_vendor','NonPerhutani')->get(), 'vehicle'=>vehicle::where('is_delete','0')->get(),'handling'=>Handling::where('is_delete','0')->get(), 'pims'=>PIM::find($id), 'pim'=>PIM::where(['is_delete'=>'0'])->get(), 'species'=>$species, 'kbm'=>KBM::all(), 'kph'=>KPH::all(), 'tpk'=>TPK::all(), 'nmvendor'=>$nmvendor, 'address'=>$address, 'city'=>$city, 'certificate'=>$certificate_name[0], 'fsc'=>$kode_fsc, 'spec1'=>$spec_name, 'objective'=>Objective::where('is_delete','0')->get()  ]);
    }

    public function delete($id)
    {
        $pim = PIM::find($id);
        $pim->update(['is_delete'=> '1']);
        return back()->with('success', 'Data has been delete.');
    }
}
