<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\PIM;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;
use App\RegisterCode;
use App\Warehouse;
use App\Certificate;
use App\Species;
use App\Quality;
use App\Specification;
use App\STreg;
use App\STregdet;
use App\Owner;
use App\TT;
use App\PO;
use App\Vendor;
use App\TPK;
use App\KPH;
use App\ComponentItem;

class STcontroller extends Controller
{
    public function create()
    {
        $tt = DB::table('tandaterima')
            ->leftJoin('pim', 'tandaterima.pimid', '=', 'pim.id')
            ->leftJoin('po_transaction', 'pim.po_reference', 'po_transaction.id')
            ->leftJoin('species', 'po_transaction.speciess' ,'=', 'species.id')
            ->leftJoin('tpk','pim.tpk_id', '=','tpk.id')
            ->leftJoin('vendor', 'pim.vendor_id','=', 'vendor.id')
            ->select('tandaterima.*','tandaterima.id as tt_id', 'pim.code_pim', 'pim.pimno', 'po_transaction.code', 'species.name as speciesname', 'pim.sortimen', 'pim.noparcel','vendor.name_vendor','tpk.name_tpk', 'pim.noprocurement')
        ->get();

        return view('sawn-timber.create')->with(['datas'=>Departemen::all(), 'regcode'=>RegisterCode::where('is_delete','0')->get(), 'warehouse'=>Warehouse::where('is_delete','0')->get(), 'certificate'=>Certificate::all(), 'species'=>Species::all(), 'quality'=>Quality::where('is_delete','0')->get(), 'specification'=>Specification::all(), 'owners'=>Owner::where('is_delete','0')->get(), 'tt'=>$tt, 'streg_det'=>STregdet::all(), 'compitem'=>ComponentItem::where('is_delete','0')->get() ]);
    }

    public function select_tt($id)
    {
        $tt_code = TT::where('id', $id)->pluck('code_tt');
        $tt_no = TT::where('id', $id)->pluck('tt_no');

        $no_doc = TT::where('id',$id)->pluck('no_document');
        $doc_qty = TT::where('id',$id)->pluck('doc_qty');
        $doc_m3 = TT::where('id',$id)->pluck('docm3');

        $pimid = TT::where('id',$id)->pluck('pimid');
        $code_pim = PIM::where('id',$pimid)->pluck('code_pim');
        $pimno = PIM::where('id',$pimid)->pluck('pimno');

        $po_id = PIM::where('id', $pimid)->pluck('po_reference');
        $po = PO::where('id',$po_id)->pluck('code');

        $prm = PIM::where('id', $pimid)->pluck('noprocurement');
        $vendor_id = PIM::where('id', $pimid)->pluck('vendor_id');
        $vendor_name = Vendor::where('id',$vendor_id)->pluck('name_vendor');
        $tpk_id = PIM::where('id',$pimid)->pluck('tpk_id');
        $tpkname = TPK::where('id',$tpk_id)->pluck('name_tpk');

        //kph = concession
        $kphid = PIM::where('id', $pimid)->pluck('kph_id');
        $kph = KPH::where('id',$kphid)->pluck('name_kph');

        $doc = PO::where('id',$po_id)->pluck('document');
        $measu = PO::where('id',$po_id)->pluck('measurement');
        $npwp = PO::where('id',$po_id)->pluck('npwp');
        $incoterms = PO::where('id',$po_id)->pluck('incoterms');
        $noparcel = PIM::where('id',$pimid)->pluck('noparcel');
        $notransport = PIM::where('id', $pimid)->pluck('notransport');
        $speciesid = PO::where('id', $po_id)->pluck('speciess');
        $species = Species::where('id', $speciesid)->pluck('name');

        $certificate_id = PO::where('id',$po_id)->pluck('certificate');
        $certificate = Certificate::where('id',$certificate_id)->pluck('cert_name');

        
        return json_encode(array($id, $tt_code, $prm, $vendor_name, $tpkname, $tt_no, $noparcel, $species, $no_doc, $doc_qty, $doc_m3, $certificate
        ));
    }

    public function edit($id)
    {
        // dd($id);
        $st = DB::table('sawntimber_regdetail as b')
            ->leftJoin('sawntimber_reg as a', 'b.reg_id', 'a.code')
            ->leftJoin('tandaterima', 'a.tt_id', 'tandaterima.id')
            ->leftJoin('pim', 'tandaterima.pimid', 'pim.id')
            ->leftJoin('vendor', 'pim.vendor_id', 'vendor.id')
            ->leftJoin('tpk','pim.tpk_id', 'tpk.id')
            ->leftJoin('po_transaction as po', 'pim.po_reference', 'po.id')
            ->leftJoin('certificate as cert', 'po.certificate', 'cert.id')
            ->leftJoin('species as s', 'po.speciess', 's.id')
            ->leftJoin('owner as own', 'a.owner', 'own.id')
            ->leftJoin('warehouse as wh', 'a.warehouse', 'wh.id')
            ->leftJoin('quality as q', 'a.quality', 'q.id')
            ->leftJoin('specification as sp1', 'a.spec1', 'sp1.id')
            ->leftJoin('specification as sp3', 'a.spec3', 'sp3.id')
            ->select('a.code as regid','a.reg_code','a.tt_id', 'tandaterima.code_tt','tandaterima.tt_no','pim.noparcel','pim.noprocurement', 'vendor.name_vendor','tpk.name_tpk','a.owner','own.owner_code','a.warehouse','wh.warehouse_code','a.description','a.min','a.max','tandaterima.no_document','tandaterima.doc_qty','tandaterima.docm3','a.quality','q.quality_code','a.applydate','a.status','a.location','a.lhp','a.kmk','a.mapping','a.spec1','sp1.name as sp1name','a.spec3','sp3.name as sp3name','a.item','a.kdnon','s.name as speciesname','cert.cert_code','b.*')
            ->where('b.id', $id)
        ->get();

        // 'species.name as speciesname'
        // dd($st);
        $tt = DB::table('tandaterima')
            ->leftJoin('pim', 'tandaterima.pimid', '=', 'pim.id')
            ->leftJoin('po_transaction', 'pim.po_reference', 'po_transaction.id')
            ->leftJoin('species', 'po_transaction.speciess' ,'=', 'species.id')
            ->leftJoin('tpk','pim.tpk_id', '=','tpk.id')
            ->leftJoin('vendor', 'pim.vendor_id','=', 'vendor.id')
            ->select('tandaterima.*','tandaterima.id as tt_id', 'pim.code_pim', 'pim.pimno', 'po_transaction.code', 'species.name as speciesname', 'pim.sortimen', 'pim.noparcel','vendor.name_vendor','tpk.name_tpk', 'pim.noprocurement')
        ->get();

        return view('sawn-timber.edit')->with(['datas'=>Departemen::all(), 'sts'=>$st[0], 'st'=>STregdet::find($id), 'regcode'=>RegisterCode::where('is_delete','0')->get(), 'warehouse'=>Warehouse::where('is_delete','0')->get(),  'quality'=>Quality::where('is_delete','0')->get(), 'specification'=>Specification::all(), 'owners'=>Owner::where('is_delete','0')->get(), 'streg_det'=>STregdet::all(), 'tt'=>$tt, 'compitem'=>ComponentItem::where('is_delete','0')->get() ]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tt' => ['required'],
            'applydate' => ['required'],
            'pallet' => ['required'],
            'height1' => ['required'],
            'height2' => ['required'],
            'width1' => ['required'],
            'width2' => ['required'],
            'lengthsm3' => ['required'],
            'lengthpm3'  => ['required'],
            'qty' => ['required'],
        ]);

        // //detail
        $d = STregdet::find($id);
        $d->pallet = $request->get('pallet');
        $d->height1 = $request->get('height1');
        $d->height2 = $request->get('height2');
        $d->width1 = $request->get('width1');
        $d->width2 = $request->get('width2');
        $d->allowence = $request->get('allowence');
        $d->lengthsm3 = $request->get('lengthsm3');
        $d->lengthpm3 = $request->get('lengthpm3');
        $d->qty = $request->get('qty');
        $d->save();
        
        //header
        $regid = $request->get('regid');
        $g = STreg::find($regid);
        $g->reg_code = $request->get('reg_code');
        $g->tt_id = $request->get('tt_id');
        $g->description = $request->get('description');
        $g->warehouse = $request->get('warehouse');
        $g->min = $request->get('min');
        $g->max = $request->get('max');
        $g->quality = $request->get('quality');
        $g->owner = $request->get('owner');
        $g->applydate = $request->get('applydate');
        $g->status = $request->get('status');
        $g->location = $request->get('location');
        $g->lhp = $request->get('lhp');
        $g->kmk = $request->get('kmk');
        $g->mapping = $request->get('mapping');
        $g->spec1 = $request->get('spec1');
        $g->kdnon = $request->get('kdnon');
        $g->spec3 = $request->get('spec3');
        $g->item = $request->get('item');
        $g->save();
        
        return redirect()->back()->with('success', 'Data has been updated');

    }

    public function store(Request $request)
    {
        $reg_code = $request->get('reg_code');
        $regcode_id = (int)$reg_code;
        $regcode = RegisterCode::where('id', $regcode_id)->pluck('code')[0];
        
        $applydate = $request->get('applydate');
        $year = Str::substr($applydate, 2, 2);
        $i = '1';
        $urutan = str_pad($i,5,'0',STR_PAD_LEFT); 
        
    }

    public function store_tblgrade(Request $request)
    {
        if($request->ajax())
        {
            $rules = array(
                'tt' => 'required',
                'applydate' => 'required',
                'pallet' => 'required',
                'height1' => 'required',
                'height2' => 'required',
                'width1' => 'required',
                'width2' => 'required',
                'lengthsm3.*' => 'required',
                'lengthpm3.*'  => 'required',
                'qty.*' => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

                // FORMAT CODE KITIR = 2 digit reg_code. 2 digit thn angkaterakhir. 5digit nourut = KK2000001
                $reg_code = $request->get('reg_code');
                $regcode_id = (int)$reg_code;
                $regcode = RegisterCode::where('id', $regcode_id)->pluck('code')[0];

                $applydate = $request->get('applydate');
                $year = Str::substr($applydate, 2, 2);
                $index = '1';
                $urutan = str_pad($index,5,'0',STR_PAD_LEFT); 
                $code = $regcode.$year.$urutan;
                
                //detail
                // $code_st = $code
                $pallet = $request->get('pallet');
                $height1 = $request->get('height1');
                $height2 = $request->get('height2');
                $width1 = $request->get('width1');
                $width2 = $request->get('width2');
                $alw = $request->get('allowence');
                $lengthsm3 = $request->get('lengthsm3');
                $lengthpm3 = $request->get('lengthpm3');
                $qty = $request->get('qty');

                $cek = STregdet::all();
                if(! $cek->isEmpty())
                {
                    //ada
                    $rc = STregdet::get()->last()->code;
                    $rcs = Str::substr($rc, 4, 5);
                    $r_c = $rcs + 1;
                    $rc_ = str_pad($r_c,5,'0',STR_PAD_LEFT); 
                    
                    $regids = STregdet::pluck('reg_id')->last();
                    $regid = $regids + 1;

                    for($i = 0; $i < count($lengthsm3); $i++)
                    {
                        $data = array(
                            'reg_id' => $regid,
                            'code' =>$regcode.$year.$rc_, //kode kitir
                            'pallet' =>$pallet,
                            'height1' =>$height1,
                            'height2' =>$height2,
                            'width1' =>$width1,
                            'width2' =>$width2,
                            'allowence' =>$alw[$i],
                            'lengthsm3' => $lengthsm3[$i],
                            'lengthpm3' => $lengthpm3[$i],
                            'qty' => $qty[$i]
                        );

                        //$insert_data[] = $data; 
                        STregdet::create($data);
                    }

                    //header
                    $s = new STreg();
                    $s->reg_code = $request->get('reg_code');
                    $s->tt_id = $request->get('tt_id');
                    $s->description = $request->get('description');
                    $s->warehouse = $request->get('warehouse');
                    $s->min = $request->get('min');
                    $s->max = $request->get('max');
                    $s->quality = $request->get('quality');
                    $s->owner = $request->get('owner');
                    $s->applydate = $request->get('applydate');
                    $s->status = $request->get('status');
                    $s->location = $request->get('location');
                    $s->lhp = $request->get('lhp');
                    $s->kmk = $request->get('kmk');
                    $s->mapping = $request->get('mapping');
                    $s->spec1 = $request->get('spec1');
                    $s->kdnon = $request->get('kdnon');
                    $s->spec3 = $request->get('spec3');
                    $s->item =$request->get('item');

                    $last_regid = STregdet::get()->last()->reg_id;
                    $s->code = $last_regid;
                    $s->save();
                    return response()->json([
                        'success'  => 'Data grade has been saved.',
                    ]);
                }
                else
                {   
                    //kosong
                    $regid = '1';
                    for($i = 0; $i < count($lengthsm3); $i++)
                    {
                        $data = array(
                            'reg_id' => $regid,
                            'code' =>$regcode.$year.$urutan, //kode kitir
                            'pallet' =>$pallet,
                            'height1' =>$height1,
                            'height2' =>$height2,
                            'width1' =>$width1,
                            'width2' =>$width2,
                            'allowence' =>$alw[$i],
                            'lengthsm3' => $lengthsm3[$i],
                            'lengthpm3' => $lengthpm3[$i],
                            'qty' => $qty[$i]
                        );

                        $insert_data[] = $data; 
                        STregdet::create($data);
                    }

                    //header
                    $s = new STreg();
                    $s->reg_code = $request->get('reg_code');
                    $s->tt_id = $request->get('tt_id');
                    $s->description = $request->get('description');
                    $s->warehouse = $request->get('warehouse');
                    $s->min = $request->get('min');
                    $s->max = $request->get('max');
                    $s->quality = $request->get('quality');
                    $s->owner = $request->get('owner');
                    $s->applydate = $request->get('applydate');
                    $s->status = $request->get('status');
                    $s->location = $request->get('location');
                    $s->lhp = $request->get('lhp');
                    $s->kmk = $request->get('kmk');
                    $s->mapping = $request->get('mapping');
                    $s->spec1 = $request->get('spec1');
                    $s->kdnon = $request->get('kdnon');
                    $s->spec3 = $request->get('spec3');
                    $s->item =$request->get('item');

                    $last_regid = STregdet::get()->last()->reg_id;
                    $s->code = $last_regid;
                    $s->save();
                    
                    return response()->json([
                        'success'  => 'Data grade has been saved.',
                    ]);

                }

        }
       
    }

}
