<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Departemen;
use App\Itemgroup;
use App\Company; 
use App\Warehouse;
use App\Objective;
use App\Remarks;
use App\Measurement;
use App\Tax;
use App\TT;
use App\PIM;
use App\Species;
use App\Specification;
use App\Itemproduct;
use App\PO;
use App\Certificate;
use App\ReceiptLog;
use App\receiptgrader;
use Validator;
use App\ReceiptNonLogExternal;
use App\ReceiptNonLogGraderIn;
use App\ReceiptNonLogVendor;
use App\ReceiptNonLogDocument;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VendorReceiptNonLogImport;
use App\Exports\VendorReceiptNonLogExport;
use App\Exports\DocumentReceiptNonLogExport;
use App\Imports\DocumentReceiptNonLogImport;
use DataTables;

class ReceiptNonLogController extends Controller
{
    public function index()
    {
        $tt = DB::table('tandaterima')
            ->leftJoin('pim', 'tandaterima.pimid', '=', 'pim.id')
            ->leftJoin('po_transaction', 'pim.po_reference', 'po_transaction.id')
            ->leftJoin('species', 'po_transaction.speciess' ,'=', 'species.id')
            ->leftJoin('tpk','pim.tpk_id', '=','tpk.id')
            ->leftJoin('vendor', 'pim.vendor_id','=', 'vendor.id')
            ->select('tandaterima.*','tandaterima.id as tt_id', 'pim.code_pim', 'pim.pimno', 'po_transaction.code', 'species.name as speciesname', 'pim.sortimen', 'pim.noparcel','vendor.name_vendor','tpk.name_tpk')
        ->get();
        $receipts = ReceiptLog::ttnonlog();

        $rgrader = DB::table('receiptlogdetail_grader')
                ->leftJoin('receiptlog', 'receiptlogdetail_grader.noreceiptlog', 'receiptlog.id')
                ->select('receiptlogdetail_grader.*', 'receiptlog.code')
                // ->where('receiptlog.code', 'like', 'F015/02/%')
                ->where('receiptlog.type_receipt', '2')
                ->get();

                // Tebal*Lebar*Panjang*Qty/1000000000
                // b.width1 * b.height1 * b.lengthpm3 * b.qty / 1000000000 as pm3
                // b.width2 * b.height2 * b.lengthsm3 * b.qty / 1000000000 as sm3
        $graderins = DB::table('receiptnonlog_graderin as in')
                ->leftJoin('receiptlog', 'in.receiptlog_id', 'receiptlog.id')
                ->leftJoin('sawntimber_reg as a', 'in.st_id', 'a.code')
                ->leftJoin('sawntimber_regdetail as b', 'a.code', 'b.reg_id')
                ->leftJoin('specification as s', 'a.kdnon', 's.id')
                ->select('b.code as codedetail', 'b.pallet', 'b.height1', 'b.height2', 'b.width1', 'b.width2', 'b.allowence', 'b.lengthsm3', 'b.lengthpm3', 'b.qty', 'a.kdnon', 'receiptlog.code as code_receipt', 's.legend as speclegend')
                ->where(['in.is_delete'=>'0', 'a.is_delete'=>'0'])
                ->orderBy('in.id','desc')
                ->get();

        $vendors = DB::table('receiptnonlog_vendor as b')
                ->leftJoin('receiptlog as a', 'b.receiptlog_id', 'a.id')
                ->leftJoin('quality as c', 'b.quality', 'c.id')
                ->leftJoin('specification as s', 'b.spec2', 's.id')
                ->select('a.code', 'b.*', 'c.quality_legend', 's.legend as speclegend')
                ->where(['a.is_delete'=>'0'])
                ->orderBy('b.receiptlog_id', 'desc')
                ->get();
        $documents = DB::table('receiptnonlog_document as b')
                ->leftJoin('receiptlog as a', 'b.receiptlog_id', 'a.id')
                ->leftJoin('quality as c', 'b.quality', 'c.id')
                ->leftJoin('specification as s', 'b.spec2', 's.id')
                ->select('a.code', 'b.*', 'c.quality_legend', 's.legend as speclegend')
                ->where(['a.is_delete'=>'0'])
                ->orderBy('b.receiptlog_id', 'desc')
                ->get();
        $external = DB::table('receiptnonlog_graderin as in')
                ->leftJoin('sawntimber_reg as s', 'in.st_id', 's.code')
                ->leftJoin('sawntimber_regdetail as d', 's.code', 'd.reg_id')
                ->leftJoin('receiptlog as r', 'in.receiptlog_id', 'r.id')
                ->leftJoin('receiptnonlog_vendor as ven', 'in.receiptlog_id', 'ven.receiptlog_id')
                ->leftJoin('receiptnonlog_document as doc', 'in.receiptlog_id', 'doc.receiptlog_id')
                ->leftJoin('quality as q', 's.quality', 'q.id')
                ->leftJoin('quality as ql', 'doc.quality','ql.id')
                ->leftJoin('quality as qlt', 'ven.quality', 'qlt.id')
                ->leftJoin('specification as spec', 's.kdnon', 'spec.id')
                ->select('in.*', 'ven.length as venlength','ven.height as venheight','ven.width as venwidth','ven.m3 as venm3', 'ven.qty as venqty', 'ven.spec2 as venspec2', 'doc.length as doclength','doc.height as docheight','doc.width as docwidth','doc.m3 as docm3','doc.qty as docqty','doc.spec2 as docspec2', 'r.code as codereceipt','d.code as codest', 'd.pallet', 'd.height1', 'd.height2', 'd.width1', 'd.width2','d.allowence','d.lengthsm3','d.lengthpm3','d.qty as qtyst', 'q.quality_legend as inquality','ql.quality_legend as docquality','qlt.quality_legend as venquality', 'spec.legend as kdnon')
                ->orderBy('in.id', 'desc')
                ->get();

        return view('receipt-nonlog.create')->with([ 'datas'=>Departemen::all(), 'itemgroup'=>Itemgroup::where('is_delete','0')->get(), 'company'=>Company::all(), 'warehouse'=>Warehouse::where(['is_delete'=>'0'])->get(), 'objective'=>Objective::where('is_delete','0')->get(), 'remarks'=>Remarks::where('is_delete','0')->get(), 'measurement'=>Measurement::where('is_delete','0')->get(), 'taxs'=>Tax::all(), 'tt'=>$tt, 'receipt'=>ReceiptLog::where(['is_delete'=>'0','type_receipt'=>'2'])->orderBy('id', 'desc')->get(), 'rgrader'=>$rgrader, 'receipts'=>$receipts, 'graderins'=>$graderins, 'vendors'=>$vendors, 'document'=>$documents, 'externals'=>$external ]);
    }

    public function store(Request $request)
    {
        
            $request->validate([
                'applydate' => ['required'],
                'division' => ['required'],
                'tt_id' => ['required','unique:receiptlog']
            ]);
            // FORMAT CODE RECEIPT NON LOG
            // F015/02/SFMP/0819/855

            $get_applydate = $request->get('applydate'); //2020-02-28
            $year = Str::substr($get_applydate, 2, 2);
            $yr = Str::substr($year, -2);
            $month = Str::substr($get_applydate, 5, 2);

            $i = '1';
            $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

            $rl = ReceiptLog::all();
            if(! $rl->isEmpty()) //check
            {
                //ada
                $code = ReceiptLog::get()->last()->code;
                $cr = Str::substr($code, -4);
                $crl = $cr+1;
                $crlg = str_pad($crl,4,'0',STR_PAD_LEFT); 
                $codereceipt = 'F015/02/SFMP/'.$month.$yr.'/'.$crlg;

            }
            else
            {
                //kosong
                // F015/01/SFMP/blnthn/urutan
                $codereceipt = 'F015/02/SFMP/'.$month.$yr.'/'.$urutan;
            }

            $r = new ReceiptLog();
            $r->code = $codereceipt;
            $r->pimid = $request->get('pimid');
            $r->tt_id = $request->get('ttid');
            $r->status = $request->get('status');
            $r->itemgroup_id = $request->get('itemgroup_id');
            $r->division = $request->get('division');
            $r->applydate = $request->get('applydate');
            $r->from_warehouse = $request->get('from_warehouse');
            $r->to_warehouse = $request->get('to_warehouse');
            $r->objective = $request->get('objective');
            $r->ppc = $request->get('ppc');
            $r->remarks = $request->get('remarks');
            $r->perni = $request->get('perni');
            $r->fakb = $request->get('fakb');
            $r->unitsize = $request->get('unitsize');
            $r->unitprice = $request->get('unitprice');
            $r->source_price = $request->get('source_price');

            $r->pph23 = $request->get('pph23');
            $r->pph22 = $request->get('pph22');
            $r->pph21 = $request->get('pph21');
            $r->ppn = $request->get('ppn');
            $r->trucking = $request->get('trucking');
            $r->administration = $request->get('administration');
            $r->lainlain = $request->get('lainlain');
            $r->unit_trucking = $request->get('unit_trucking');
            // 2=receipt nonlog; 1=receiptlog
            $r->type_receipt = '2';
            $r->save();

            return redirect()->back()->with('success', 'Data has been saved.');
        // }
    }

    public function storegraderin(Request $request)
    {
        //statusgrader : 0 (grader in) , 1 (graderout)
        if($request->ajax())
        {
            $rules = array(
                'graderin.*' => 'required',
                'location_graderin.*'  => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }


            $graderin = $request->get('graderin');
            $location_graderin = $request->get('location_graderin');

            $noreceiptnonlog = $request->get('noreceiptnonlog');
           
            for($count = 0; $count < count($graderin); $count++)
            {
                $data = array(
                    'noreceiptlog' =>$noreceiptnonlog,
                    'name' => $graderin[$count],
                    'location' => $location_graderin[$count],
                    'statusgrader' => '0'
                );

                $insert_data[] = $data; 
                receiptgrader::create($data);
            }
            
            //buat ngecek
            return response()->json([
                'success'  => 'Data grader-in added successfully.',
                // 'data' => $insert_data
            ]);

            // return back()->with('success', 'Data Grader-in has been saved.');
        }
    }

    public function storegraderout(Request $request)
    {
        //statusgrader : 0 (grader in) , 1 (graderout)
        if($request->ajax())
        {
            $rules = array(
                'graderout.*' => 'required',
                'location_graderout.*'  => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }


            $graderout = $request->get('graderout');
            $location_graderout = $request->get('location_graderout');

            $noreceiptnonlog = $request->get('noreceiptnonlog_graderout');
           
            for($count = 0; $count < count($graderout); $count++)
            {
                $data = array(
                    'noreceiptlog' =>$noreceiptnonlog,
                    'name' => $graderout[$count],
                    'location' => $location_graderout[$count],
                    'statusgrader' => '1'
                );

                $insert_data[] = $data; 
                receiptgrader::create($data);
            }
            
            //buat ngecek
            return response()->json([
                'success'  => 'Data grader-out added successfully.',
                // 'data' => $insert_data
            ]);

        }
    }

    public function generate_itemcode($id)
    {
        //ambil data dari receipt non log - graderin
        // group by Spec1,Spec2,quality,height,width,length
        $graderin = DB::table('receiptnonlog_graderin as in')
                ->leftJoin('sawntimber_reg as a', 'in.st_id', 'a.code')
                ->leftJoin('sawntimber_regdetail as b', 'a.code', 'b.reg_id')
                ->leftJoin('owner as c', 'a.owner', 'c.id')
                ->leftJoin('specification as d', 'a.kdnon', 'd.id')
                ->leftJoin('quality as e', 'a.quality', 'e.id')
                ->select('a.*', 'b.*', 'c.owner_legend', 'd.legend', 'e.quality_legend')
                ->where(['in.receiptlog_id'=>$id, 'in.is_delete'=>'0'])
                ->groupBy('b.height1', 'b.width1', 'b.lengthpm3','a.quality')
                ->get();
            
        foreach($graderin as $in)
        {   
            $pimid = TT::where('id',$in->tt_id)->pluck('pimid');
            $po_id = PIM::where('id', $pimid)->pluck('po_reference');
            $speciesid = PO::where('id', $po_id)->pluck('speciess');
            $species = Species::where('id', $speciesid)->pluck('legend');
            $certificateid = PO::where('id',$po_id)->pluck('certificate');
            $certificate = Certificate::where('id',$certificateid)->pluck('legend');

            //Format codeproduct/itemcode :
            //OWNER-.SPECIES.CERTIFICATE.SPEC2KDNON.QUALITY.HEIGHT2.WIDTH2.LENGTHSM3
            $owner = $in->owner_legend;
            $speciesName = $species[0];
            $certificateName = $certificate[0];
            $spec2 = $in->legend;
            $quality = $in->quality_legend;
            $height = $in->height2;
            $width = $in->width2;
            $length = $in->lengthsm3;

            $codeProduct = $owner.'-'.$speciesName.'-'.$certificateName.'-'.$spec2
            .'-'.$quality.'-'.$height.'-'.$width.'-'.$length;


            //sebelumnya, cek dulu last noproduct di tabel itemproduct
            $items = Itemproduct::all();
            if(! $items->isEmpty())
            {
                //sudah ada noproduct di tbl itemproduct-prm
                $lastNoProduct = Itemproduct::get()->last()->noproduct_id;
                $noproduct = $lastNoProduct + 1;

                $lastVcode = Itemproduct::get()->last()->vcode;
                $vcode = $lastVcode + 1;

                $data = array(
                    'receiptlog_id' => $id,
                    'noproduct'=>$noproduct
                );

                
                $dataItemProduct = array(
                    'noproduct_id' => $noproduct,
                    'codeproduct' => $codeProduct,
                    'vcode' => $vcode,
                    'type' => '1'
                );

                //insert ke tabel receiptnonlog_external
                //insert ke tabel itemproduct_prm
                try
                {
                    DB::table('receiptnonlog_external')->insert($data); 
                    DB::table('itemproduct_prm')->insert($dataItemProduct);
                }
                catch(\Illuminate\Database\QueryException $e)
                {
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == '1062')
                    {
                        return back()->with('warning', 'Duplicate entry.');
                    }
                }
            }
            else
            {
                //belum ada noproduct -> noproduct = 1
                $noproduct = 1;
                $vcode = 1;
                $data = array(
                    'receiptlog_id' => $id,
                    'noproduct'=>$noproduct
                );

                $dataItemProduct = array(
                    'noproduct_id' => $noproduct,
                    'codeproduct' => $codeProduct,
                    'vcode' => $vcode,
                    'type' => '1'
                );

                try
                {
                    DB::table('receiptnonlog_external')->insert($data); 
                    DB::table('itemproduct_prm')->insert($dataItemProduct);
                }
                catch(\Illuminate\Database\QueryException $e)
                {
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == '1062')
                    {
                        return back()->with('warning', 'Duplicate entry.');
                    }
                }

            }
            
            return redirect()->to('/receipt/nonlog/external')->with('success', 'Data itemcode has been generated');

        }
    }

    public function generate_pricing($id)
    {
        //ambil harga dari PO
        $pimid = ReceiptLog::where('id',$id)->pluck('pimid');
        $poid = PIM::where('id',$pimid)->pluck('po_reference');
        $pos = PO::where('id',$poid)->pluck('code');

        
        $getdetail_po = DB::table('po_transactiondet')
                ->leftJoin('quality', 'po_transactiondet.quality_id', '=', 'quality.id')
                ->select('quality.quality_code','quality.id as quality_id','po_transactiondet.invdia_min', 'po_transactiondet.invdia_max', 'po_transactiondet.invlength_min', 'po_transactiondet.invlength_max','po_transactiondet.totalprice_det')
                ->where('code_po',$pos)
                ->get();
        
        foreach($getdetail_po as $detailpo)
        {
            $quality = $detailpo->quality_id;
            $invlength_min = $detailpo->invlength_min;
            $invlength_max = $detailpo->invlength_max;
            $invdia_min = array($detailpo->invdia_min);
            $invdia_max = array($detailpo->invdia_max);
            
            //menentukan range_length
            if($invlength_min == $invlength_max)
            {
                $range_length = $invlength_max;
            }
            else
            {
                $range_length = $invlength_min.'-'.$invlength_max;
            }
            // dd($invlength_min);

            
            //grader in
            $receipt_gin = DB::table('receiptnonlog_graderin as in')
                ->leftJoin('sawntimber_reg as a', 'in.st_id', 'a.code')
                ->leftJoin('sawntimber_regdetail as b', 'a.code', 'b.reg_id')
                ->leftJoin('owner as c', 'a.owner', 'c.id')
                ->leftJoin('specification as d', 'a.kdnon', 'd.id')
                ->leftJoin('quality as e', 'a.quality', 'e.id')
                ->select('in.id as idnonlog','a.quality')
                ->where(['in.receiptlog_id'=>$id, 'in.is_delete'=>'0', 'a.quality'=>$quality])
                ->whereBetween('b.lengthpm3',[$invlength_min, $invlength_max])
                ->get();
                // dd($receipt_gin);
            // $receipt_gin = DB::table('receiptnonlog_graderin')
            //             ->select('kwt','dia_avg','p_len','nextmap')
            //             ->where([
            //                 ['receiptlog_id','=', $id],
            //                 ['kwt','=', $quality],
            //             ])
            //             ->whereBetween('dia_avg',[$invdia_min, $invdia_max])
            //             ->whereBetween('lengthpm3',[$invlength_min, $invlength_max])
            //             ->get();
            foreach($receipt_gin as $receiptgin)
            {
                $totalprice = $detailpo->totalprice_det;
                $id_nonlog = $receiptgin->idnonlog;
                
                $recgin_po = DB::table('receiptnonlog_graderin')
                        ->where('id',$id_nonlog)
                        ->update(['po_price'=>$totalprice]);
            }

        }
        return redirect()->to('receipt/nonlog/invoicing')->with('success','Generate Pricing from PO has been successfully.');

    }
    
    public function graderin($id)
    {
        $receipt = ReceiptLog::find($id);
        $id_tt = $receipt->tt_id;
        // dd($id_tt);
        $get_detail = DB::table('sawntimber_reg')
                    ->select('sawntimber_reg.*')
                    ->where(['sawntimber_reg.tt_id'=>$id_tt])
                    ->get();
        foreach($get_detail as $g)
        {
            //relasi - insert ke tabel receiptnonlog_graderin
            $in = new ReceiptNonLogGraderIn();
            $in->receiptlog_id = $id;
            $in->st_id = $g->code;
            $in->save();
            
        }
        
        // tampilkan hasilnya
        $select = DB::table('sawntimber_reg as a')
            ->leftJoin('sawntimber_regdetail as b', 'a.code', '=', 'b.reg_id')
            ->select('b.code as codedetail', 'b.pallet', 'b.height1', 'b.height2', 'b.width1', 'b.width2', 'b.allowence', 'b.lengthsm3', 'b.lengthpm3', 'b.qty')
            ->select('a.*')
            ->where(['a.tt_id'=>$id_tt])
            ->get();
        // return DataTables::of($select)->toJson();
        // return Datatables::of($select)->make(true);
        // dd($id);
        return redirect()->to('receipt/nonlog/graderin')->with('success', 'Create ST Transaction has been successfully.');
    }

    public function view_graderin($id)
    {
        $receipt = ReceiptLog::find($id);
        $id_tt = $receipt->tt_id;

        // tampilkan hasilnya
        $select = DB::table('sawntimber_reg as a')
                ->leftJoin('sawntimber_regdetail as b', 'a.code', '=', 'b.reg_id')
                ->select('b.code as codedetail', 'b.pallet', 'b.height1', 'b.height2', 'b.width1', 'b.width2', 'b.allowence', 'b.lengthsm3', 'b.lengthpm3', 'b.qty')
                ->select('a.*')
                ->where(['a.tt_id'=>$id_tt])
                ->get();
        return DataTables::of($rek)->toJson();
    }

    public function export_vendor($id)
    {
        return Excel::download(new VendorReceiptNonLogExport($id), 'ReceiptNonLogVendor_"'.$id.'".xlsx');
    }

    public function import_vendor(Request $request)
    {
        try
        {
            $request->validate([
                'importvendor' => 'required|mimes:xls,xlsx'
            ]);
            // $this->validate($request, [
            //     'importvendor' => 'required|mimes:xls,xlsx'
            // ]);

            $vendor = Excel::toCollection(new VendorReceiptNonLogImport(), $request->file('importvendor'));

            
            if($vendor[0]->count() > 1)
            // if(! $vendor[0]->isEmpty())
            {
                for($x = 1; $x < count($vendor[0]); $x++)
                {
                    
                    if(! is_null($vendor[0][$x][7]) || ! is_null($vendor[0][$x][8]) || ! is_null($vendor[0][$x][0]))
                    {
                        //not null
                        $fquality = DB::select('SELECT convert_quality(?) AS quality_id', [$vendor[0][$x][7]])[0];
                        $quality = $fquality->quality_id;

                        $fspecification = DB::select('SELECT convert_specification(?) as spec_id', [$vendor[0][$x][8]])[0];
                        $specification = $fspecification->spec_id;

                        $freceipt = DB::select('SELECT convert_receiptlogID(?) as receipt_id', [$vendor[0][$x][0]])[0];
                        $receipt = $freceipt->receipt_id;

                    }else{
                        //null
                        $quality = $vendor[0][$x][7];
                        $specification = $vendor[0][$x][8];
                        $receipt = $vendor[0][$x][0];
                    }

                    $insertVendor = array(
                        'receiptlog_id' => $receipt,
                        'nextmap' => $vendor[0][$x][1],
                        'length' => $vendor[0][$x][2],
                        'height' => $vendor[0][$x][3],
                        'width' => $vendor[0][$x][4],
                        'm3' => $vendor[0][$x][5],
                        'qty' => $vendor[0][$x][6],
                        'quality' => $quality,
                        'spec2' => $specification
                    );
                    // dd($insertVendor);
                    ReceiptNonLogVendor::create($insertVendor);
                }
            }
            else
            {

            }
            
            
        }
        catch(\Exception $ex)
        {
            return back()->with('warning', 'Select file type: .xls, .xlsx required');
        }

        return redirect()->to('receipt/nonlog/vendor')->with('success', 'File vendor upload successfully.');
    }

    public function export_document($id)
    {
        return Excel::download(new DocumentReceiptNonLogExport($id), 'ReceiptNonLogDocument_"'.$id.'".xlsx');
    }

    public function import_document(Request $request)
    {
        try
        {
            $request->validate([
                'importdocument' => 'required|mimes:xls,xlsx'
            ]);

            $document = Excel::toCollection(new DocumentReceiptNonLogImport(), $request->file('importdocument'));

            // dd($document);

            if($document[0]->count() > 1)
            {
                for($x = 1; $x < count($document[0]); $x++)
                {
                    
                    if(! is_null($document[0][$x][7]) || ! is_null($document[0][$x][8]) || ! is_null($document[0][$x][0]))
                    {
                        //not null
                        $fquality = DB::select('SELECT convert_quality(?) AS quality_id', [$document[0][$x][7]])[0];
                        $quality = $fquality->quality_id;

                        $fspecification = DB::select('SELECT convert_specification(?) as spec_id', [$document[0][$x][8]])[0];
                        $specification = $fspecification->spec_id;

                        $freceipt = DB::select('SELECT convert_receiptlogID(?) as receipt_id', [$document[0][$x][0]])[0];
                        $receipt = $freceipt->receipt_id;

                    }else{
                        //null
                        $quality = $document[0][$x][7];
                        $specification = $document[0][$x][8];
                        $receipt = $document[0][$x][0];
                    }

                    $insertDocument = array(
                        'receiptlog_id' => $receipt,
                        'nextmap' => $document[0][$x][1],
                        'length' => $document[0][$x][2],
                        'height' => $document[0][$x][3],
                        'width' => $document[0][$x][4],
                        'm3' => $document[0][$x][5],
                        'qty' => $document[0][$x][6],
                        'quality' => $quality,
                        'spec2' => $specification
                    );
                    ReceiptNonLogDocument::create($insertDocument);
                }
            }
            else
            {

            }
            
        }
        catch(\Exception $ex)
        {
            return back()->with('warning', 'Select file type: .xls, .xlsx required');
        }

        return redirect()->to('receipt/nonlog/document')->with('success', 'File document upload successfully.');
    }
}
