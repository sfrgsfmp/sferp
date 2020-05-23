<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Company;
use App\ItemGroup;
use App\Warehouse;
use App\PIM;
use App\Certificate;
use App\PO;
use App\PO_detail;
use App\Species;
use App\Wwf;
use App\Vendor;
use App\KPH;
use App\TPK;
use App\IndProv;
use App\IndDistrict;
use App\IndCity;
use App\IndVillage;
use App\Objective;
use App\vehicle;
use App\Specification;
use App\Handling;
use App\TT;
use Illuminate\Support\Str;
use App\Barcodelist;
use Validator;

class TTcontroller extends Controller
{
    public function create()
    {
        return view('tandaterima.create')->with(['datas'=>Departemen::all(), 'company'=>Company::all(), 'itemgroup'=>ItemGroup::all(), 'warehouses'=>Warehouse::where('is_delete','0')->get(), 'pims'=>PIM::where('is_delete','0')->get(), 'provs'=>IndProv::all(), 'tts'=>TT::where('is_delete','0')->get() ]);
    }

    public function selectpim($id)
    {
        $codepim = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code_pim');
        $pimno = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('pimno');
        $noprocurement = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('noprocurement');
        $noparcel = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('noparcel');

        $po_id = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('po_reference');
        $po = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('code');
        // $species = PO_detail::where(['code_po'=>$po, 'is_delete'=>'0'])->pluck('species_id');
        $species = PO::where(['id'=>$po_id, 'is_delete'=>'0'])->pluck('speciess');

        $speciesname = Species::where('id',$species)->pluck('name');

        $certificate_id = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('certificate');
        $certificate_name = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('cert_name');
        $kode_fsc = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('kode_fsc');
        $wwfid = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('wwf_id');
        $wwf = Wwf::where(['id'=>$wwfid, 'is_delete'=>'0'])->pluck('name');

        $vendorid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('vendor_id');
        $vendorname = Vendor::where(['id'=>$vendorid])->pluck('name_vendor');
        $kph_id = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('kph_id');
        $kph = KPH::where(['id'=>$kph_id])->pluck('name_kph');
        $tpk_id = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('tpk_id');
        $tpk = TPK::where('id',$tpk_id)->pluck('name_tpk');

        $objectiveid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('objective');
        $objective = Objective::where(['id'=>$objectiveid, 'is_delete'=>'0'])->pluck('objective_name');

        $whbong = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('whbongkar');
        $whbongkar = Warehouse::where(['id'=>$whbong, 'is_delete'=>'0'])->pluck('warehouse_name');
        $whsta = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('whstapel');
        $whstapel = Warehouse::where(['id'=>$whsta, 'is_delete'=>'0'])->pluck('warehouse_name');
        $starttime = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('starttime');
        $endtime = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('endtime');
        $headcount = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('headcount');

        $typetransid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('type_transport_id');
        $typetransport = vehicle::where(['id'=>$typetransid, 'is_delete'=>'0'])->pluck('vehicle_name');
        $notransport = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('notransport');
        $spb = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('spb');
        $sortimen = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('sortimen');
        $po_id = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('po_reference');
        $spec1 = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('spec_id');
        $spec1_name = Specification::where(['id'=>$spec1])->pluck('name');

        $contractorid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('contractor_id');
        $contractor = Vendor::where(['id'=>$contractorid])->pluck('name_vendor');
        $workshift = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('workshift');
        $rateused = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('rateused');
        $handlingid = PIM::where(['id'=>$id, 'is_delete'=>'0'])->pluck('handling');
        $handling = Handling::where(['id'=>$handlingid, 'is_delete'=>'0'])->pluck('name');


        return json_encode(array($id,$codepim,$pimno,$noprocurement,$noparcel,$speciesname,$certificate_name, $kode_fsc, $wwf,$vendorname, $tpk, $kph, $objective, $whbongkar, $whstapel, $typetransport, $notransport, $starttime, $endtime,$headcount,$spb,$sortimen,$spec1_name,$contractor, $workshift, $rateused, $handling));
    }


    public function storebarcode(Request $request)
    {
        if($request->ajax())
        {
            $rules = array(
                // 'tt_id' => 'required',
                'barcode.*'  => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }


            $barcode = $request->get('barcode');
            // $tt_id = $request->get('tt_id');
           
            for($count = 0; $count < count($barcode); $count++)
            {
                $data = array(
                    // 'tt_id' => $tt_id[$count],
                    'barcode' => $barcode[$count]
                    
                );
                $insert_data[] = $data; 
            }
            // $insert_data[] += $tt_id;

            Barcodelist::create($insert_data);
            // return response()->with('success','Data Added successfully.');
            return response()->json([
                'success'  => 'Data Added successfully.'
            ]);
            
        }
    }

    public function getdistrict($id)
    {
        $get = IndDistrict::where('city_id', $id)->pluck('name', 'id');
        return json_encode($get);
    }

    public function getvillage($id)
    {
        $get = IndVillage::where('district_id', $id)->pluck('name', 'id');
        return json_encode($get);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            
            'tt_no' => ['required'],
            'phisic_qty' => ['required'],
        ]);
        
        //FORMAT TT
        $itemgroup = $request->get('itemgroup');
        $division = $request->get('division');
        $month = date('m');
        $year = date('Y');
        $yr = Str::substr($year, 2, 2);
        
        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        $codett ='';
        
        $j = TT::all();
        if(! $j->isEmpty()) //check
        {
            //ada
            $code = TT::get()->last()->code_tt;
            $cp = Str::substr($code, -4);
            $cpi = $cp+1;
            $cjo = str_pad($cpi,4,'0',STR_PAD_LEFT); 
            $codett .= 'TT/'.$itemgroup.'/'.$division.'/'.$month.$yr.'/'.$cjo;

            //untuk Nomor TT
            // $nojo = TT::get()->last()->jo;
            // $cekthn = Str::substr($nojo, 0, 2);

            // if($yr != $cekthn)
            // {
            //     $i=1;
            // }
            // else
            // {
            //     $i++;    
            // }
            // // $i = 1;
            
            // $counter = str_pad($i,5,'0',STR_PAD_LEFT); 
            // $no_jo = $yr."".$counter;

        }
        else
        {
            //kosong
            // TT/ITEMGROUP/DIVISION/blnTHN/URUTAN
            $codett .= 'TT/'.$itemgroup.'/'.$division.'/'.$month.$yr.'/'.$urutan;

           
            // $i=1;
            
            // $counter = str_pad($i,5,'0',STR_PAD_LEFT); 
            // $no_jo = $yr."".$counter;
        }

        $p = new TT();
        $p->code_tt = $codett;
        $p->tt_no = $request->get('tt_no');
        $p->form_no= $request->get('form_no');
        $p->tt_date = $request->get('tt_date');
        $p->division = $request->get('division');
        $p->itemgroup_id = $request->get('itemgroup_id');
        $p->pimid = $request->get('pimid');
        $p->sj_no = $request->get('sj_no');
        $p->dkp_no = $request->get('dkp_no');
        $p->doc_dt = $request->get('doc_dt');
        $p->code_document = $request->get('code_document');
        $p->no_document = $request->get('no_document');
        $p->doc_no = $request->get('doc_no');
        $p->cert_claim = $request->get('cert_claim');
        $p->code_concession = $request->get('code_concession');
        $p->name_concession = $request->get('name_concession');
        $p->grade_qty = $request->get('grade_qty');
        $p->phisic_qty = $request->get('phisic_qty');
        $p->doc_qty = $request->get('doc_qty');
        $p->docm3 = $request->get('docm3');
        $p->height = $request->get('height');
        $p->width = $request->get('width');
        $p->length = $request->get('length');
        $p->province = $request->get('province');
        $p->city = $request->get('city');
        $p->district = $request->get('district');
        $p->village = $request->get('village');
        $p->grade_dt = $request->get('grade_dt');
        $p->dari = $request->get('dari');
        $p->keterangan = $request->get('keterangan');
        $p->no_spb = $request->get('no_spb');
        $p->paydate = $request->get('paydate');
        $p->dischargedate = $request->get('dischargedate');
        $p->no_dokumen = $request->get('no_dokumen');
        $p->jenis = $request->get('jenis');
        $p->tipe = $request->get('tipe');
        $p->btg = $request->get('btg');
        $p->m3 = $request->get('m3');
        $p->format_phisicqty = $request->get('format_phisicqty');
        $p->save();

        return redirect()->back()->with('success', 'Data has been created');
    }

    public function edit($id)
    {
        $pimid = TT::where(['id'=>$id,'is_delete'=>'0'])->pluck('pimid');
        $po_id = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('po_reference');
        $po = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('code');
        // $species = PO_detail::where(['code_po'=>$po, 'is_delete'=>'0'])->pluck('species_id');
        $species = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('speciess');
        $speciesname = Species::where('id',$species)->pluck('name');
        
        $objectiveid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('objective');
        $objective = Objective::where(['id'=>$objectiveid, 'is_delete'=>'0'])->pluck('objective_name');

        $certificate_id = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('certificate');
        $certificate_name = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('cert_name');
        $kode_fsc = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('kode_fsc');
        $wwfid = Certificate::where(['id'=>$certificate_id, 'is_delete'=>'0'])->pluck('wwf_id');
        $wwf = Wwf::where(['id'=>$wwfid, 'is_delete'=>'0'])->pluck('name');

        $vendorid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('vendor_id');
        $vendorname = Vendor::where(['id'=>$vendorid])->pluck('name_vendor');
        $kph_id = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('kph_id');
        $kph = KPH::where(['id'=>$kph_id])->pluck('name_kph');
        $tpk_id = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('tpk_id');
        $tpk = TPK::where('id',$tpk_id)->pluck('name_tpk');

        $whbong = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('whbongkar');
        $whbongkar = Warehouse::where(['id'=>$whbong, 'is_delete'=>'0'])->pluck('warehouse_name');
        $whsta = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('whstapel');
        $whstapel = Warehouse::where(['id'=>$whsta, 'is_delete'=>'0'])->pluck('warehouse_name');
        $starttime = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('starttime');
        $endtime = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('endtime');
        $headcount = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('headcount');

        $typetransid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('type_transport_id');
        $typetransport = vehicle::where(['id'=>$typetransid, 'is_delete'=>'0'])->pluck('vehicle_name');
        $notransport = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('notransport');

        $spb = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('spb');

        $sortimen = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('sortimen');
        $spec1 = PO::where(['id'=>$po_id, 'is_delete'=>'0', 'status'=>'Approved'])->pluck('spec_id');
        $spec1_name = Specification::where(['id'=>$spec1])->pluck('name');

        $contractorid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('contractor_id');
        $contractor = Vendor::where(['id'=>$contractorid])->pluck('name_vendor');
        $workshift = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('workshift');
        $rateused = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('rateused');
        $handlingid = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('handling');
        $handling = Handling::where(['id'=>$handlingid, 'is_delete'=>'0'])->pluck('name');


        return view('tandaterima.edit')->with(['datas'=>Departemen::all(), 'company'=>Company::all(), 'itemgroup'=>ItemGroup::all(), 'warehouses'=>Warehouse::where('is_delete','0')->get(), 'pims'=>PIM::where('is_delete','0')->get(), 'provs'=>IndProv::all(), 'city'=>IndCity::all(), 'district'=>IndDistrict::all(), 'village'=>IndVillage::all(),'tts'=>TT::where('is_delete','0')->get(), 'tt'=>TT::find($id), 'species'=>$speciesname, 'objective'=>$objective, 'certificate_name'=>$certificate_name[0], 'kode_fsc'=>$kode_fsc, 'wwf'=>$wwf, 'vendorname'=>$vendorname, 'tpk'=>$tpk, 'kph'=>$kph, 'whbongkar'=>$whbongkar, 'whstapel'=>$whstapel, 'starttime'=>$starttime, 'endtime'=>$endtime, 'typetransport'=>$typetransport, 'notransport'=>$notransport, 'headcount'=>$headcount, 'spb'=>$spb, 'spec1_name'=>$spec1_name, 'sortimen'=>$sortimen, 'contractor'=>$contractor, 'workshift'=>$workshift, 'rateused'=>$rateused, 'handling'=>$handling ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tt_no' => ['required'],
            'phisic_qty' => ['required'],
        ]);

        $p = TT::find($id);
        $p->code_tt = $request->get('code_tt');
        $p->tt_no = $request->get('tt_no');
        $p->form_no= $request->get('form_no');
        $p->tt_date = $request->get('tt_date');
        $p->division = $request->get('division');
        $p->itemgroup_id = $request->get('itemgroup_id');
        $p->pimid = $request->get('pimid');
        $p->sj_no = $request->get('sj_no');
        $p->dkp_no = $request->get('dkp_no');
        $p->doc_dt = $request->get('doc_dt');
        $p->code_document = $request->get('code_document');
        $p->no_document = $request->get('no_document');
        $p->doc_no = $request->get('doc_no');
        $p->cert_claim = $request->get('cert_claim');
        $p->code_concession = $request->get('code_concession');
        $p->name_concession = $request->get('name_concession');
        $p->grade_qty = $request->get('grade_qty');
        $p->phisic_qty = $request->get('phisic_qty');
        $p->doc_qty = $request->get('doc_qty');
        $p->docm3 = $request->get('docm3');
        $p->height = $request->get('height');
        $p->width = $request->get('width');
        $p->length = $request->get('length');
        $p->province = $request->get('province');
        $p->city = $request->get('city');
        $p->district = $request->get('district');
        $p->village = $request->get('village');
        $p->grade_dt = $request->get('grade_dt');
        $p->dari = $request->get('dari');
        $p->keterangan = $request->get('keterangan');
        $p->no_spb = $request->get('no_spb');
        $p->paydate = $request->get('paydate');
        $p->dischargedate = $request->get('dischargedate');
        $p->no_dokumen = $request->get('no_dokumen');
        $p->jenis = $request->get('jenis');
        $p->tipe = $request->get('tipe');
        $p->btg = $request->get('btg');
        $p->m3 = $request->get('m3');
        $p->format_phisicqty = $request->get('format_phisicqty');
        $p->save();

        return redirect()->route('tt.create')->with('success', 'Data has been updated');
    }

    public function delete($id)
    {
        $j = TT::find($id);
        $j->update(['is_delete'=> '1']);
        return back()->with('success', 'Data has been delete.');
    }
}
