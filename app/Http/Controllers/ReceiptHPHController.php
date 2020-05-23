<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\PIM;
use App\TT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use App\Itemgroup;
use App\Company;
use App\Warehouse;
use App\Objective;
use App\Remarks;
use App\Measurement;
use App\Tax;
use App\PO;
use App\Species;
use App\Certificate;
use App\Specification;
use App\ReceiptHPH;
use App\ReceiptLog;
use App\receiptgrader;
use Validator;
use App\Itemproduct;
use App\SortimenDet;
use App\ReceiptLogVendor;
use App\ReceiptLogGraderOut;
use App\ReceiptLogGraderIn;
use App\ReceiptLogDocument;
use App\ReceiptLogExternal;
use App\ReceiptLogInvoicing;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorReceiptHPHexport;
use App\Imports\VendorReceiptHPHimport;
use App\Exports\GraderOutReceiptHPHexport;
use App\Imports\GraderOutReceiptHPHimport;
use App\Imports\GraderInReceiptHPHimport;
use App\Exports\GraderInReceiptHPHexport;
use App\Exports\DocumentReceiptHPHexport;
use App\Imports\DocumentReceiptHPHimport;
use App\Exports\ExternalReceiptHPHreport;
use App\Exports\InvoicingReceiptHPHreport;

class ReceiptHPHController extends Controller
{
    public function index()
    {
        $rexternal = DB::table('receiptlogdetail_external')
        ->leftJoin('receiptlogdetail_vendor', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_vendor.nextmap')
        ->leftJoin('receiptlogdetail_graderin', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_graderin.nextmap')
        ->leftJoin('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
        ->leftJoin('receiptlog', 'receiptlogdetail_external.receiptlog_id', '=', 'receiptlog.id')
        ->leftJoin('quality', 'receiptlogdetail_document.quality','=','quality.id')
        ->leftJoin('kphtype', 'receiptlogdetail_document.kphtype','=','kphtype.id')
        ->leftJoin('quality as vq', 'receiptlogdetail_vendor.quality','=','vq.id')
        ->leftJoin('kphtype as vkphtype', 'receiptlogdetail_vendor.kphtype','=','vkphtype.id')
        ->leftJoin('quality as inq', 'receiptlogdetail_graderin.kwt','=','inq.id')
        ->leftJoin('kphtype as inkphtype', 'receiptlogdetail_graderin.kph_type','=','inkphtype.id')
        ->leftJoin('sortimen as inclass', 'receiptlogdetail_graderin.class','=','inclass.id')

        ->select('receiptlog.code','receiptlogdetail_external.nextmap as enextmap','receiptlogdetail_external.noproduct',
        'receiptlogdetail_document.nokayu as dnokayu',
         'receiptlogdetail_document.dia as ddia',
         'receiptlogdetail_document.length as dlength',
         'receiptlogdetail_document.height as dheight',
         'receiptlogdetail_document.width as dwidth',
          'receiptlogdetail_document.m3 as dm3',
          'receiptlogdetail_document.nobarcode as dnobarcode', 
          'receiptlogdetail_document.nopohon as dnopohon',
           'receiptlogdetail_document.nopetak as dnopetak',
           'receiptlogdetail_document.nokapling as dnokapling',
           'receiptlogdetail_document.nobp as dnobp',
           'receiptlogdetail_document.umurkapling as dumurkapling',
           'receiptlogdetail_document.kayuno2 as dkayuno2',
           'receiptlogdetail_document.partaibp as dpartaibp',
           'receiptlogdetail_document.asaltahun as dasaltahun',
            'quality.quality_code as dquality',
            'kphtype.code as dkphtype',
           'receiptlogdetail_document.hjd as dhjd',
           'receiptlogdetail_document.price_po as dprice_po',
           'receiptlogdetail_document.range_size as drange_size',
           'receiptlogdetail_document.range_length as drange_length',
           'receiptlogdetail_vendor.nokayu as vnokayu',
            'receiptlogdetail_vendor.dia as vdia',
             'receiptlogdetail_vendor.length as vlength', 'receiptlogdetail_vendor.height as vheight', 'receiptlogdetail_vendor.width as vwidth',
              'receiptlogdetail_vendor.m3 as vm3',
               'receiptlogdetail_vendor.nobarcode as vnobarcode', 'receiptlogdetail_vendor.nopohon as vnopohon', 'receiptlogdetail_vendor.nopetak as vnopetak', 
            //    'receiptlogdetail_vendor.quality as vquality', 
                'vq.quality_code as vquality',
            //    'receiptlogdetail_vendor.kphtype as vkphtype', 
                'vkphtype.code as vkphtype',
               'receiptlogdetail_vendor.hjd as vhjd', 
               'receiptlogdetail_vendor.price_po as vprice_po', 
               'receiptlogdetail_vendor.range_size as vrange_size', 
               'receiptlogdetail_vendor.range_length as vrange_length', 
               'receiptlogdetail_graderin.nokayu as innokayu',
                // 'receiptlogdetail_graderin.kwt as inkwt', 
                'inq.quality_code as inkwt',
                'receiptlogdetail_graderin.dia1 as india1', 'receiptlogdetail_graderin.dia2 as india2', 'receiptlogdetail_graderin.dia3 as india3', 'receiptlogdetail_graderin.dia4 as india4', 'receiptlogdetail_graderin.dia_avg as indiaavg',
                //  'receiptlogdetail_graderin.class as inclass',
                 'inclass.code as inclass',
                  'receiptlogdetail_graderin.heightfull as inheightfull', 'receiptlogdetail_graderin.widthfull as inwidthfull', 'receiptlogdetail_graderin.lenfull as inlenfull', 'receiptlogdetail_graderin.lenmin as inlenmin', 'receiptlogdetail_graderin.lennett as inlennett', 'receiptlogdetail_graderin.heighttrim as inheighttrim', 'receiptlogdetail_graderin.widthtrim as inwidthtrim','receiptlogdetail_graderin.lengr as inlengr', 'receiptlogdetail_graderin.lenkm as inlenkm', 'receiptlogdetail_graderin.lentrim as inlentrim', 'receiptlogdetail_graderin.heightmin as inheightmin', 'receiptlogdetail_graderin.heightnett as inheightnett', 'receiptlogdetail_graderin.widthmin as inwidthmin', 'receiptlogdetail_graderin.widthnett as inwidthnett', 'receiptlogdetail_graderin.p_len as inp_len', 'receiptlogdetail_graderin.p_m3 as inp_m3', 'receiptlogdetail_graderin.dia_gr as india_gr', 'receiptlogdetail_graderin.nobarcode as innobarcode', 'receiptlogdetail_graderin.nopohon as innopohon', 'receiptlogdetail_graderin.nopetak as innopetak', 'receiptlogdetail_graderin.po_price as inpo_price', 'receiptlogdetail_graderin.gross_price as ingross_price', 'receiptlogdetail_graderin.discount as indiscount', 'receiptlogdetail_graderin.discount_value as indiscountvalue', 'receiptlogdetail_graderin.surcharges as insurcharges', 'receiptlogdetail_graderin.surcharges_value as insurcharges_value', 'receiptlogdetail_graderin.adj as inadj', 
                  'receiptlogdetail_graderin.totprice as intotprice',
                  'receiptlogdetail_graderin.dia1_teras as india1_teras', 'receiptlogdetail_graderin.dia2_teras as india2_teras', 'receiptlogdetail_graderin.dia3_teras as india3_teras', 'receiptlogdetail_graderin.dia4_teras as india4_teras', 'receiptlogdetail_graderin.diaavg_teras as indiaavg_teras', 'receiptlogdetail_graderin.p_m3_teras as inp_m3_teras', 'receiptlogdetail_graderin.po_price_teras as inpo_price_teras', 'receiptlogdetail_graderin.gross_price_teras as ingross_price_teras', 'receiptlogdetail_graderin.discount_teras as indiscountteras',
                   'receiptlogdetail_graderin.discountvalue_teras as indiscountvalue_teras', 
                   'receiptlogdetail_graderin.surcharges_teras as insurcharges_teras', 
                   'receiptlogdetail_graderin.surcharges_value_teras as insurcharges_value_teras', 
                   'receiptlogdetail_graderin.adj_teras as inadj_teras',
                    'receiptlogdetail_graderin.totprice_teras as intotprice_teras', 
                    'receiptlogdetail_graderin.owner as inowner',
                    'inkphtype.code as inkphtype',
                    'receiptlogdetail_graderin.hjd as inhjd',
                    'receiptlogdetail_graderin.range_size as inrange_size',
                    'receiptlogdetail_graderin.range_length as inrange_length')
                ->get(); 

        $rhph = DB::table('receipthph')
                ->leftJoin('receiptlog', 'receipthph.id', '=', 'receiptlog.id_receipthph')
                ->leftJoin('tandaterima', 'receiptlog.tt_id','=','tandaterima.id')
                ->leftJoin('pim', 'receiptlog.pimid', '=', 'pim.id')
                ->leftJoin('po_transaction', 'pim.po_reference', '=', 'po_transaction.id')
                ->select('receipthph.id','receipthph.code_hph', 'receiptlog.code as code_log', 'tandaterima.code_tt', 'pim.code_pim', 'pim.pimno', 'pim.noprocurement', 'tandaterima.tt_no', 'po_transaction.code as code_po', 'pim.noparcel')
                ->where(['receipthph.is_delete'=>'0'])
                ->orderBy('id', 'desc')
                ->get();
        
        return view('receipt-hph.input')->with(['datas'=>Departemen::all(), 'pims'=>PIM::where(['is_delete'=>'0'])->get(), 'itemgroup'=>Itemgroup::where('is_delete','0')->get(), 'company'=>Company::all(), 'warehouse'=>Warehouse::where(['is_delete'=>'0'])->get(), 'objective'=>Objective::where('is_delete','0')->get(), 'remarks'=>Remarks::where('is_delete','0')->get(), 'measurement'=>Measurement::where('is_delete','0')->get(), 'taxs'=>Tax::all(), 'receiptlogs'=>ReceiptLog::where(['is_delete'=>'0'])->orderBy('id', 'desc')->get(), 'rgrader'=>receiptgrader::all(), 'rvendors'=>ReceiptLogVendor::all(), 'receipthphs'=>$rhph, 'rgraderout'=>ReceiptLogGraderOut::all(), 'rgraderin'=>ReceiptLogGraderIn::all(), 'rdocument'=>ReceiptLogDocument::all(), 'rexternal'=>$rexternal, 'invoicing'=> ReceiptLogInvoicing::all(), 'receipt'=>ReceiptLog::where(['is_delete'=>'0'])->orderBy('id', 'desc')->get() ]);
    }

    public function editgeneral($id)
    {
        return view('receipt-hph.edit')->with(['datas'=>Departemen::all(), 'pims'=>PIM::where(['is_delete'=>'0'])->get(), 'itemgroup'=>Itemgroup::where('is_delete','0')->get(), 'company'=>Company::all(), 'warehouse'=>Warehouse::where(['is_delete'=>'0'])->get(), 'objective'=>Objective::where('is_delete','0')->get(), 'remarks'=>Remarks::where('is_delete','0')->get(), 'measurement'=>Measurement::where('is_delete','0')->get(), 'taxs'=>Tax::all(), 'receiptlogs'=>ReceiptLog::where(['is_delete'=>'0'])->orderBy('id', 'desc')->get(), 'rgrader'=>receiptgrader::all(), 'rvendors'=>ReceiptLogVendor::all(), 'receipthphs'=>$rhph, 'rgraderout'=>ReceiptLogGraderOut::all(), 'rgraderin'=>ReceiptLogGraderIn::all(), 'rdocument'=>ReceiptLogDocument::all(), 'rexternal'=>$rexternal, 'invoicing'=> ReceiptLogInvoicing::all(), 'receipt'=>ReceiptHPH::where(['is_delete'=>'0'])->get()]);
    }

    public function view_tt($id)
    {
        
        $tt = DB::table('tandaterima')
            ->leftJoin('pim','tandaterima.pimid','=','pim.id')
            ->select('tandaterima.tt_date','tandaterima.code_tt','tandaterima.tt_no','tandaterima.no_dokumen as no_dokumenasal','tandaterima.phisic_qty','tandaterima.doc_qty', 'pim.code_pim')
            ->where([
                ['tandaterima.is_delete','=','0'],
                ['tandaterima.pimid','=',$id]
            ])
            ->get();
        return DataTables::of($tt)->toJson();
    }

    public function select_pim($id)
    {
        $pim = DB::table('pim')
            ->leftJoin('po_transaction','pim.po_reference','=','po_transaction.id')
            ->leftJoin('vendor','pim.vendor_id','=','vendor.id')
            ->leftJoin('tpk', 'pim.tpk_id', '=', 'tpk.id')
            ->leftJoin('kph','pim.kph_id','=','kph.id')
            ->leftJoin('species','po_transaction.speciess','=','species.id')
            ->leftJoin('certificate as c','po_transaction.certificate', '=','c.id')

            ->select('*','po_transaction.id as po_id','po_transaction.code as codepo', 'vendor.name_vendor', 'tpk.name_tpk', 'kph.name_kph', 'po_transaction.document', 'po_transaction.measurement','po_transaction.npwp','po_transaction.incoterms','species.name as speciesname', 'c.cert_name')
            ->where(['pim.id'=>$id,'pim.is_delete'=>'0'])->get();

        foreach($pim as $pim)
        {
            return json_encode(array($id, $pim->code_pim, $pim->pimno, $pim->po_id, $pim->codepo, $pim->noprocurement, $pim->vendor_id, $pim->name_vendor, $pim->name_tpk, $pim->name_kph, $pim->document, $pim->measurement, $pim->npwp, $pim->incoterms, $pim->noparcel, $pim->speciesname, $pim->cert_name ));
        }
        
    }

    public function get_ttid($id)
    {
        $tt = TT::where(['is_delete'=>'0','pimid'=>$id])->pluck('id');
        return json_encode(array($tt));
    }

    public function select_hph($id)
    {
        $hph = ReceiptHPH::find($id)->pluck('code_hph')[0];
        return json_encode(array($hph));
    }

    public function generate_itemcode($ids)
    {
        $int_id = (int)$ids;
       
        $id_r = ReceiptLog::where('id_receipthph',$int_id)->pluck('id');
        // dd($id_receipt);
        // for($i = 0; $i < count($id); $i++)
        // {
        foreach($id_r as $id)
        {
            $rv = ReceiptLogExternal::where('receiptlog_id',$id)->first();
            if(! $rv)
            {
                //gaada
                $rex = DB::table('receiptlogdetail_document')
                ->leftJoin('receiptlogdetail_vendor', 'receiptlogdetail_document.nextmap', '=', 'receiptlogdetail_vendor.nextmap')
                ->leftJoin('receiptlogdetail_graderin', 'receiptlogdetail_document.nextmap', '=', 'receiptlogdetail_graderin.nextmap')
                ->leftJoin('receiptlog', 'receiptlogdetail_document.receiptlog_id', '=', 'receiptlog.id')
                ->select('receiptlogdetail_document.nextmap as dnextmap', 'receiptlogdetail_document.dia as ddia', 'receiptlogdetail_document.length as dlength', 'receiptlogdetail_document.quality as dquality', 'receiptlogdetail_graderin.owner as inowner')
                ->where([
                    ['receiptlogdetail_document.receiptlog_id', '=', $id],
                    ['receiptlogdetail_vendor.receiptlog_id', '=', $id],
                    ['receiptlogdetail_graderin.receiptlog_id', '=', $id],
                ])->get();

                $rexid = Receiptlog::where('id',$id)->pluck('pimid');
                $poid = PIM::where('id',$rexid)->pluck('po_reference');
                $speciesid = PO::where('id',$poid)->pluck('speciess');
                $species = Species::where('id',$speciesid)->pluck('legend');
                $certificateid = PO::where('id',$poid)->pluck('certificate');
                $certificate = Certificate::where('id',$certificateid)->pluck('legend');
                $specid = PO::where('id',$poid)->pluck('spec_id');
                $spec = Specification::where('id',$specid)->pluck('legend');
                
                //cek tabel
                $tblre = ReceiptLogExternal::all();
                if(! $tblre->isEmpty()) //cek
                {
                    //ada
                
                    $noprod = ReceiptLogExternal::get()->max()->noproduct;
                    $vcodee = Itemproduct::get()->max()->vcode;

                    $noproductt = $noprod+1;
                    $vcodee = $vcodee+1;

                    $var = "";
                    $ar = '';
                    foreach($rex as $re)
                    {
                        //NO PRODUCT = Owner.Species.Certificate.Spec1.Quality.Diameter.Length
                        //VCODE = Owner.Species.Certificate.Spec1.Quality.Diameter

                        $cd =$re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia;
                        $code =$re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia.'-'.$re->dlength;

                        if($var != $cd)
                        {
                            $var = $cd;
                            $vars = $cd;

                            $b = $vcodee++;
                        }
                        else
                        {
                            $vars = '';
                            $b = $b;
                        }


                        if($ar != $code)
                        {
                            $ar = $code;

                            $a = $noproductt++;
                            
                        }
                        else
                        {
                            $a = $a;
                        }

                        //input receipt external
                            $data = array(
                                'receiptlog_id' => $id,
                                'nextmap' => $re->dnextmap,
                                'noproduct'=> $a,
                                'codeproduct'=>$code,
                            );
            
                            $insert_data[] = $data; 
                            // $ex = ReceiptLogExternal::create($data);
                        
                        try
                        {
                            DB::table('receiptlogdetail_external')->insert($data); 
                        }
                        catch(\Illuminate\Database\QueryException $e)
                        {
                            $errorCode = $e->errorInfo[1];
                            if($errorCode == '1062')
                            {
                                return back()->with('warning', 'Duplicate entry.');
                            }
                        }

                        //cek di tabel itemproduct apakah sudah ada codeproduct tersebut?

                        //CREATE DI TABEL ITEMPRODUCT
                        //KETIKA VENDOR/DOCUMENT ADA PERUBAHAN, MAKA DATA DI UPDATE JUGA DI TABEL ITEMPRODUCT
                    
                    } 

                    $rexi = DB::table('receiptlogdetail_external')
                    ->leftJoin('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
                    // ->join('receiptlogdetail_graderin', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_graderin.nextmap')
                    ->select('receiptlogdetail_external.noproduct','receiptlogdetail_external.codeproduct', 'receiptlogdetail_document.dia as ddia')
                    ->distinct('receiptlogdetail_external.noproduct')
                    ->where([
                        ['receiptlogdetail_external.receiptlog_id', '=', $id],
                    ])
                    // ->groupBy('receiptlogdetail_external.noproduct', 'receiptlogdetail_external.codeproduct')
                    ->get();
                    
                    // dd($rexi);

                    $rexid = Receiptlog::where('id',$id)->pluck('pimid');
                    $poid = PIM::where('id',$rexid)->pluck('po_reference');
                    $speciesid = PO::where('id',$poid)->pluck('speciess');
                    $species = Species::where('id',$speciesid)->pluck('legend');
                    $certificateid = PO::where('id',$poid)->pluck('certificate');
                    $certificate = Certificate::where('id',$certificateid)->pluck('legend');
                    $specid = PO::where('id',$poid)->pluck('spec_id');
                    $spec = Specification::where('id',$specid)->pluck('legend');

                    $vcodee = Itemproduct::get()->max()->vcode;
                    $vcodee = $vcodee+1;

                    foreach($rexi as $rexii)
                    {
                            //input itemproduct
                            $dataitem = array(
                                'noproduct_id'=> $rexii->noproduct,
                                'codeproduct'=>$rexii->codeproduct,
                                'vcode'=>$vcodee++,
                                // 'ddia'=>$rexii->ddia,
                            );

                            $insertdataitem[] = $dataitem;
                            Itemproduct::create($dataitem);
                    }
                    
                    // return redirect()->to('/receipt/hph/external')->with('success', 'Data has been generated');

                }
                else
                {
                    //kosong
                    // $noprod = ReceiptLogExternal::get()->max()->noproduct;
                    $noproductt = '1';
                    $vcodee = '1';

                    $var = '';
                    $ar = '';
                    foreach($rex as $re)
                    {
                        //NO PRODUCT = Owner.Species.Certificate.Spec1.Quality.Diameter.Length
                        //VCODE = Owner.Species.Certificate.Spec1.Quality.Diameter

                        $cd = $re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia;
                        $code = $re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia.'-'.$re->dlength;

                        if($var != $cd)
                        {
                            $var = $cd;
                            $vars = $cd;

                            $b = $vcodee++;
                        }
                        else
                        {
                            $vars = '';
                            $b = $b;
                        
                        }

                        if($ar != $code)
                        {
                            $ar = $code;
                            $a = $noproductt++;
                        }
                        else
                        {
                            $a = $a;
                        }


                        $data = array(
                            'receiptlog_id' => $id,
                            'nextmap' => $re->dnextmap,
                            'noproduct'=> $a,
                            'codeproduct'=>$code,
                        );

                        $insert_data[] = $data; 
                        // $ex = ReceiptLogExternal::create($data);

                        try
                        {
                            DB::table('receiptlogdetail_external')->insert($data); 
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

                

                    $rexi = DB::table('receiptlogdetail_external')
                        ->leftJoin('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
                        ->select('receiptlogdetail_external.noproduct','receiptlogdetail_external.codeproduct', 'receiptlogdetail_document.dia as ddia')
                        ->distinct('receiptlogdetail_external.noproduct')
                        ->where([
                            ['receiptlogdetail_external.receiptlog_id', '=', $id],
                        ])->get();

                    $rexid = Receiptlog::where('id',$id)->pluck('pimid');
                    $poid = PIM::where('id',$rexid)->pluck('po_reference');
                    $speciesid = PO::where('id',$poid)->pluck('speciess');
                    $species = Species::where('id',$speciesid)->pluck('legend');
                    $certificateid = PO::where('id',$poid)->pluck('certificate');
                    $certificate = Certificate::where('id',$certificateid)->pluck('legend');
                    $specid = PO::where('id',$poid)->pluck('spec_id');
                    $spec = Specification::where('id',$specid)->pluck('legend');

                    $vcodee = '1';

                    foreach($rexi as $rexii)
                    {
                        //input itemproduct
                        $dataitem = array(
                            'noproduct_id'=> $rexii->noproduct,
                            'codeproduct'=>$rexii->codeproduct,
                            'vcode'=>$vcodee++,
                        );

                        $insertdataitem[] = $dataitem;
                        Itemproduct::create($dataitem);
                    }
                    
                    // return redirect()->to('/receipt/hph/external')->with('success', 'Data has been generated');
                }

            }
            else
            {
            }
            
            // $rex = DB::table('receiptlogdetail_document')
            //     ->leftJoin('receiptlogdetail_vendor', 'receiptlogdetail_document.nextmap', '=', 'receiptlogdetail_vendor.nextmap')
            //     ->leftJoin('receiptlogdetail_graderin', 'receiptlogdetail_document.nextmap', '=', 'receiptlogdetail_graderin.nextmap')
            //     ->leftJoin('receiptlog', 'receiptlogdetail_document.receiptlog_id', '=', 'receiptlog.id')
            //     ->select('receiptlogdetail_document.nextmap as dnextmap', 'receiptlogdetail_document.dia as ddia', 'receiptlogdetail_document.length as dlength', 'receiptlogdetail_document.quality as dquality', 'receiptlogdetail_graderin.owner as inowner')
            //     ->where([
            //         ['receiptlogdetail_document.receiptlog_id', '=', $id[$i]],
            //         ['receiptlogdetail_vendor.receiptlog_id', '=', $id[$i]],
            //         ['receiptlogdetail_graderin.receiptlog_id', '=', $id[$i]],
            //     ])->get();
            
            //     $rexid = Receiptlog::where('id',$id[$i])->pluck('pimid');
            //     $poid = PIM::where('id',$rexid)->pluck('po_reference');
            //     $speciesid = PO::where('id',$poid)->pluck('speciess');
            //     $species = Species::where('id',$speciesid)->pluck('legend');
            //     $certificateid = PO::where('id',$poid)->pluck('certificate');
            //     $certificate = Certificate::where('id',$certificateid)->pluck('legend');
            //     $specid = PO::where('id',$poid)->pluck('spec_id');
            //     $spec = Specification::where('id',$specid)->pluck('legend');
                
            //     //cek tabel
            //     $tblre = ReceiptLogExternal::all();
            //     if(! $tblre->isEmpty()) //cek
            //     {
            //         //ada
                
            //         $noprod = ReceiptLogExternal::get()->max()->noproduct;
            //         $vcodee = Itemproduct::get()->max()->vcode;
        
            //         $noproductt = $noprod+1;
            //         $vcodee = $vcodee+1;
        
            //         $var = "";
            //         $ar = '';
            //         foreach($rex as $re)
            //         {
            //             //NO PRODUCT = Owner.Species.Certificate.Spec1.Quality.Diameter.Length
            //             //VCODE = Owner.Species.Certificate.Spec1.Quality.Diameter
        
            //             $cd =$re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia;
            //             $code =$re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia.'-'.$re->dlength;
        
            //             if($var != $cd)
            //             {
            //                 $var = $cd;
            //                 $vars = $cd;
        
            //                 $b = $vcodee++;
            //             }
            //             else
            //             {
            //                 $vars = '';
            //                 $b = $b;
            //             }
        
        
            //             if($ar != $code)
            //             {
            //                 $ar = $code;
            //                 $a = $noproductt++;
            //             }
            //             else
            //             {
            //                 $a = $a;
            //             }
        
            //             //input receipt external
            //                 $data = array(
            //                     'receiptlog_id' => $id[$i],
            //                     'nextmap' => $re->dnextmap,
            //                     'noproduct'=> $a,
            //                     'codeproduct'=>$code,
            //                 );
            
            //                 $insert_data[] = $data; 
            //                 // $ex = ReceiptLogExternal::create($data);
                        
            //             try
            //             {
            //                 DB::table('receiptlogdetail_external')->insert($data); 
            //             }
            //             catch(\Illuminate\Database\QueryException $e)
            //             {
            //                 $errorCode = $e->errorInfo[1];
            //                 if($errorCode == '1062')
            //                 {
            //                     return back()->with('warning', 'Duplicate entry.');
            //                 }
            //             }
        
            //             //cek di tabel itemproduct apakah sudah ada codeproduct tersebut?
        
            //             //CREATE DI TABEL ITEMPRODUCT
            //             //KETIKA VENDOR/DOCUMENT ADA PERUBAHAN, MAKA DATA DI UPDATE JUGA DI TABEL ITEMPRODUCT
                      
            //         } 
        
            //         $rexi = DB::table('receiptlogdetail_external')
            //             ->leftJoin('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
            //             // ->join('receiptlogdetail_graderin', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_graderin.nextmap')
            //             ->select('receiptlogdetail_external.noproduct','receiptlogdetail_external.codeproduct', 'receiptlogdetail_document.dia as ddia')
            //             ->distinct('receiptlogdetail_external.noproduct')
            //             ->where([
            //                 ['receiptlogdetail_external.receiptlog_id', '=', $id[$i]],
            //             ])
            //             // ->groupBy('receiptlogdetail_external.noproduct', 'receiptlogdetail_external.codeproduct')
            //             ->get();
                    
            //         // dd($rexi);
        
            //         $rexid = Receiptlog::where('id',$id[$i])->pluck('pimid');
            //         $poid = PIM::where('id',$rexid)->pluck('po_reference');
            //         $speciesid = PO::where('id',$poid)->pluck('speciess');
            //         $species = Species::where('id',$speciesid)->pluck('legend');
            //         $certificateid = PO::where('id',$poid)->pluck('certificate');
            //         $certificate = Certificate::where('id',$certificateid)->pluck('legend');
            //         $specid = PO::where('id',$poid)->pluck('spec_id');
            //         $spec = Specification::where('id',$specid)->pluck('legend');
        
            //         $vcodee = Itemproduct::get()->max()->vcode;
            //         $vcodee = $vcodee+1;
        
            //         foreach($rexi as $rexii)
            //         {
            //                 //input itemproduct
            //                 $dataitem = array(
            //                     'noproduct_id'=> $rexii->noproduct,
            //                     'codeproduct'=>$rexii->codeproduct,
            //                     'vcode'=>$vcodee++,
            //                     // 'ddia'=>$rexii->ddia,
            //                 );
        
            //                 $insertdataitem[] = $dataitem;
            //                 Itemproduct::create($dataitem);
            //         }
                    
            //         return redirect()->to('/receipt/hph/external')->with('success', 'Data has been generated');
        
            //     }
            //     else
            //     {
            //         //kosong
            //         // $noprod = ReceiptLogExternal::get()->max()->noproduct;
            //         $noproductt = '1';
            //         $vcodee = '1';
        
            //         $var = '';
            //         $ar = '';
            //         foreach($rex as $re)
            //         {
            //             //NO PRODUCT = Owner.Species.Certificate.Spec1.Quality.Diameter.Length
            //             //VCODE = Owner.Species.Certificate.Spec1.Quality.Diameter
        
            //             $cd = $re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia;
            //             $code = $re->inowner.'-'.$species[0].'-'.$certificate[0].'-'.$spec[0].'-'.$re->dquality.'-'.$re->ddia.'-'.$re->dlength;
        
            //             if($var != $cd)
            //             {
            //                 $var = $cd;
            //                 $vars = $cd;
        
            //                 $b = $vcodee++;
            //             }
            //             else
            //             {
            //                 $vars = '';
            //                 $b = $b;
                           
            //             }
        
            //             if($ar != $code)
            //             {
            //                 $ar = $code;
            //                 $a = $noproductt++;
            //             }
            //             else
            //             {
            //                 $a = $a;
            //             }
        
        
            //             $data = array(
            //                 'receiptlog_id' => $id[$i],
            //                 'nextmap' => $re->dnextmap,
            //                 'noproduct'=> $a,
            //                 'codeproduct'=>$code,
            //             );
        
            //             $insert_data[] = $data; 
            //             // $ex = ReceiptLogExternal::create($data);
        
            //             try
            //             {
            //                 DB::table('receiptlogdetail_external')->insert($data); 
            //             }
            //             catch(\Illuminate\Database\QueryException $e)
            //             {
            //                 $errorCode = $e->errorInfo[1];
            //                 if($errorCode == '1062')
            //                 {
            //                     return back()->with('warning', 'Duplicate entry.');
            //                 }
            //             }
        
            //         } 
        
                   
        
            //         $rexi = DB::table('receiptlogdetail_external')
            //             ->leftJoin('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
            //             ->select('receiptlogdetail_external.noproduct','receiptlogdetail_external.codeproduct', 'receiptlogdetail_document.dia as ddia')
            //             ->distinct('receiptlogdetail_external.noproduct')
            //             ->where([
            //                 ['receiptlogdetail_external.receiptlog_id', '=', $id[$i]],
            //             ])->get();
        
            //         $rexid = Receiptlog::where('id',$id[$i])->pluck('pimid');
            //         $poid = PIM::where('id',$rexid)->pluck('po_reference');
            //         $speciesid = PO::where('id',$poid)->pluck('speciess');
            //         $species = Species::where('id',$speciesid)->pluck('legend');
            //         $certificateid = PO::where('id',$poid)->pluck('certificate');
            //         $certificate = Certificate::where('id',$certificateid)->pluck('legend');
            //         $specid = PO::where('id',$poid)->pluck('spec_id');
            //         $spec = Specification::where('id',$specid)->pluck('legend');
        
            //         $vcodee = '1';
        
            //         foreach($rexi as $rexii)
            //         {
            //             //input itemproduct
            //             $dataitem = array(
            //                 'noproduct_id'=> $rexii->noproduct,
            //                 'codeproduct'=>$rexii->codeproduct,
            //                 'vcode'=>$vcodee++,
            //             );
        
            //             $insertdataitem[] = $dataitem;
            //             Itemproduct::create($dataitem);
            //         }
                    
            //         return redirect()->to('/receipt/hph/external')->with('success', 'Data has been generated');
            //     }
        
            
        }
        
        return redirect()->to('/receipt/hph/external')->with('success', 'Data has been generated');
    }

    public function generate_pricing($ids)
    {
        $int_ids = (int)$ids;
        $id_r = ReceiptLog::where('id_receipthph',$int_ids)->pluck('id');
        foreach($id_r as $id)
        {
            //generate pricing untuk price dari PO
            //bandingkan document.quality = po.quality_id, document.dia = range(po.invdia_min,invdia_max), document.length = range(po.invlength_min,po.invlength_max)
            //setelah itu dapet price_po dan diupdate ke tabel document
            
            $pimid = ReceiptLog::where('id',$id)->pluck('pimid');
            $poid = PIM::where('id',$pimid)->pluck('po_reference');
            $pos = PO::where('id',$poid)->pluck('code');

            
            $getdetail_po = DB::table('po_transactiondet')
                    ->join('quality', 'po_transactiondet.quality_id', '=', 'quality.id')
                    ->select('quality.quality_code','quality.id as quality_id','po_transactiondet.invdia_min', 'po_transactiondet.invdia_max', 'po_transactiondet.invlength_min', 'po_transactiondet.invlength_max','po_transactiondet.totalprice_det')
                    ->where('code_po',$pos)
                    ->get();
            
            foreach($getdetail_po as $detailpo)
            {
                // $quality = array($detailpo->quality_id);
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

                //document
                $receipt_doc = DB::table('receiptlogdetail_document')
                            ->select('quality','dia','length','nextmap')
                            ->where([
                                ['receiptlog_id','=', $id],
                                ['quality', '=', $quality],
                            ])
                            ->whereBetween('dia',[$invdia_min, $invdia_max])
                            ->whereBetween('length',[$invlength_min, $invlength_max])
                            ->get();

                foreach($receipt_doc as $receiptdoc)
                {
                    $totalprice = $detailpo->totalprice_det;
                    $nextmap = $receiptdoc->nextmap;

                    $recdoc_po = DB::table('receiptlogdetail_document')
                            ->where('nextmap',$nextmap)
                            ->update(['price_po'=>$totalprice,'range_length'=>$range_length]);
                }

                //vendor
                $receipt_ven = DB::table('receiptlogdetail_vendor')
                            ->select('quality','dia','length','nextmap')
                            ->where([
                                ['receiptlog_id','=', $id],
                                ['quality', '=', $quality],
                            ])
                            ->whereBetween('dia',[$invdia_min, $invdia_max])
                            ->whereBetween('length',[$invlength_min, $invlength_max])
                            ->get();

                foreach($receipt_ven as $receiptven)
                {
                    $totalprice = $detailpo->totalprice_det;
                    $nextmap = $receiptven->nextmap;
                    
                    $recven_po = DB::table('receiptlogdetail_vendor')
                            ->where('nextmap',$nextmap)
                            ->update(['price_po'=>$totalprice, 'range_length'=>$range_length]);
                }

                //grader in
                $receipt_gin = DB::table('receiptlogdetail_graderin')
                            ->select('kwt','dia_avg','p_len','nextmap')
                            ->where([
                                ['receiptlog_id','=', $id],
                                ['kwt','=', $quality],
                            ])
                            ->whereBetween('dia_avg',[$invdia_min, $invdia_max])
                            ->whereBetween('p_len',[$invlength_min, $invlength_max])
                            ->get();
                foreach($receipt_gin as $receiptgin)
                {
                    $totalprice = $detailpo->totalprice_det;
                    $nextmap = $receiptgin->nextmap;
                    
                    $recgin_po = DB::table('receiptlogdetail_graderin')
                            ->where('nextmap',$nextmap)
                            ->update(['po_price'=>$totalprice, 'range_length'=>$range_length]);
                }

                //grader out
                $receipt_gout = DB::table('receiptlogdetail_graderout')
                        ->select('kwt','dia_avg','p_len','nextmap')
                        ->where([
                            ['receiptlog_id','=', $id],
                            ['kwt','=', $quality],
                        ])
                        ->whereBetween('dia_avg',[$invdia_min, $invdia_max])
                        ->whereBetween('p_len',[$invlength_min, $invlength_max])
                        ->get();
                foreach($receipt_gout as $receiptgout)
                {
                    $totalprice = $detailpo->totalprice_det;
                    $nextmap = $receiptgout->nextmap;
                    
                    $recgout_po = DB::table('receiptlogdetail_graderout')
                            ->where('nextmap',$nextmap)
                            ->update(['po_price'=>$totalprice, 'range_length'=>$range_length]);
                }

            }
        }
        return redirect()->to('receipt/hph/invoicing')->with('success','Generate Pricing from PO has been successfully.');
        
    }

    public function generate_invoicing($ids)
    {
        $int_ids = (int)$ids;
        $id_r = ReceiptLog::where('id_receipthph',$int_ids)->pluck('id');
        foreach($id_r as $id)
        {
            //RANGE SIZE
            $get_sortimen = DB::table('sortimendet')
            ->leftJoin('sortimen','sortimendet.sortimen_code','=','sortimen.id')
            ->select('sortimen.code','sortimendet.*')
            ->get();
            foreach($get_sortimen as $getsortimen)
            {
                $get_dia = $getsortimen->dia_det;
                $get_sortimencode = $getsortimen->code;
                $get_range_size = $getsortimen->range_size;

                //grader in
                $receipt_gin = DB::table('receiptlogdetail_graderin')
                        ->select('dia_avg','nextmap')
                        ->where([
                            ['receiptlog_id','=', $id],
                            ['dia_avg','=', $get_dia],
                        ])->get();
                foreach($receipt_gin as $recpgin)
                {
                    // $rangesize_in = $getsortimen->range_size;

                    $nextmap = $recpgin->nextmap;

                    //update range_size
                    $recgin_po = DB::table('receiptlogdetail_graderin')
                            ->where('nextmap',$nextmap)
                            ->update(['range_size'=>$get_range_size]);
                }


                //grader out
                $receipt_gout = DB::table('receiptlogdetail_graderout')
                        ->select('dia_avg','nextmap')
                        ->where([
                            ['receiptlog_id','=', $id],
                            ['dia_avg','=', $get_dia],
                        ])->get();
                foreach($receipt_gout as $recpgout)
                {
                    // $rangesize_gout = $getsortimen->range_size;
                    $nextmap = $recpgout->nextmap;

                    //update range_size
                    $recgin_po = DB::table('receiptlogdetail_graderin')
                            ->where('nextmap',$nextmap)
                            ->update(['range_size'=>$get_range_size]);
                }
        


                //document
                $receipt_doc = DB::table('receiptlogdetail_document')
                        ->select('dia','nextmap')
                        ->where([
                            ['receiptlog_id','=', $id],
                            ['dia','=', $get_dia],
                        ])->get();
                foreach($receipt_doc as $recpdoc)
                {
                    // $rangesizedoc = $get_sortimen->range_size;
                    $nextmap = $recpdoc->nextmap;

                    //updaate range_size
                    DB::table('receiptlogdetail_document')
                            ->where('nextmap',$nextmap)
                            ->update(['range_size'=>$get_range_size]);
                }

                //vendor
                $receipt_ven = DB::table('receiptlogdetail_vendor')
                        ->select('dia','nextmap')
                        ->where([
                            ['receiptlog_id','=', $id],
                            ['dia','=', $get_dia],
                        ])->get();
                foreach($receipt_ven as $recpven)
                {
                    // $rangesize_ven = $get_sortimen->range_size;
                    $nextmap = $recpven->nextmap;
                    //updaate range_size
                    DB::table('receiptlogdetail_vendor')
                            ->where('nextmap',$nextmap)
                            ->update(['range_size'=>$get_range_size]);
                }
            
            }


            //invoicing groupby by grader in
            $in = DB::table('receiptlogdetail_graderin as a')
                ->select(DB::raw('a.dia_avg, a.range_size, a.range_length, a.kwt, a.kph_type, a.hjd, a.po_price, a.p_m3,
                (SELECT SUM(m3) FROM receiptlogdetail_document b WHERE b.receiptlog_id = '.$id.' AND b.range_size = a.range_size AND b.range_length = a.range_length AND b.quality = a.kwt AND b.kphtype = a.kph_type) as doc_m3,
                (SELECT count(m3) FROM receiptlogdetail_document b WHERE b.receiptlog_id = '.$id.' AND b.range_size = a.range_size AND b.range_length = a.range_length AND b.quality = a.kwt AND b.kphtype = a.kph_type) as doc_qty,

                (SELECT SUM(m3) from receiptlogdetail_vendor c where c.receiptlog_id = '.$id.' AND c.range_size = a.range_size AND c.range_length = a.range_length AND c.quality = a.kwt AND c.kphtype = a.kph_type) as ven_m3,
                (SELECT count(m3) FROM receiptlogdetail_vendor c WHERE c.receiptlog_id = '.$id.' AND c.range_size = a.range_size AND c.range_length = a.range_length AND c.quality = a.kwt AND c.kphtype = a.kph_type) as ven_qty,

                (SELECT sum(p_m3) FROM receiptlogdetail_graderout d WHERE d.receiptlog_id = '.$id.' AND d.range_size = a.range_size AND d.range_length = a.range_length AND d.kwt = a.kwt AND d.kph_type = a.kph_type) as gout_m3,
                (SELECT count(p_m3) FROM receiptlogdetail_graderout d WHERE d.receiptlog_id = '.$id.' AND d.range_size = a.range_size AND d.range_length = a.range_length AND d.kwt = a.kwt AND d.kph_type = a.kph_type) as gout_qty
                '))
                ->where('a.receiptlog_id', '=', $id)
                ->groupBy('a.range_size','a.range_length','a.kwt','a.kph_type')
                ->get();    

                foreach($in as $in)
                {
                    //source code dari receiptlog_id = 0 /1 ?
                    $sc = Receiptlog::where('id',$id)->pluck('source_price')[0];
                    if($sc == '0'){
                        //dari PO
                        $price_in = $in->po_price;
                    }elseif($sc == '1'){
                        //dari HJD
                        $price_in = $in->hjd;
                    }else{
                        $price_in = '0';
                    }

                    //sortimen
                    $sortimen = DB::table('sortimendet')->where(['dia_det'=>$in->dia_avg,'range_size'=>$in->range_size])->pluck('sortimen_code');
                    $sortimens = count($sortimen) == 0 ? '': $sortimen[0];
                    // dd($sortimens);

                    //select grader in
                    $gin = DB::table('receiptlogdetail_graderin')
                        ->select(DB::raw('SUM(p_m3) as in_m3'), DB::raw('COUNT(p_m3) as in_qty'))
                        ->where([
                            ['receiptlog_id','=',$id],
                            ['range_size','=',$in->range_size],
                            ['range_length','=',$in->range_length],
                            ['kwt','=',$in->kwt],
                            ['kph_type','=',$in->kph_type]
                        ])->get();
                        
                    foreach($gin as $gin)
                    {
                        //insert ke tabel baru receipt_invoicing
                        //jika sudah ada, maka update
                        //jika blm ada, insert
                        $cekk = DB::table('receiptlogdetail_invoicing')
                                ->where([
                                    ['receiptlog_id', $id],
                                    ['range_size',$in->range_size],
                                    ['range_length',$in->range_length],
                                    ['quality',$in->kwt],
                                    ['sortimen',$sortimens],
                                    ['kphtype',$in->kph_type]
                                ])->get();
                        if(! $cekk->isEmpty())
                        {
                            //ada -> update
                            $invoice_update = DB::table('receiptlogdetail_invoicing')
                                            ->where([
                                                ['receiptlog_id', $id],
                                                ['range_size',$in->range_size],
                                                ['range_length',$in->range_length],
                                                ['quality',$in->kwt],
                                                ['sortimen',$sortimens],
                                                ['kphtype',$in->kph_type],
                                            ])
                                            ->update([
                                                'receiptlog_id'=> $id,
                                                'range_size'=>$in->range_size,
                                                'range_length'=>$in->range_length,
                                                'quality'=>$in->kwt,
                                                'sortimen'=>$sortimens,
                                                'kphtype'=>$in->kph_type,
                                                'price'=>$price_in,
            
                                                'in_qty'=> $gin->in_qty,
                                                'in_m3'=> $gin->in_m3,
                                                'in_totprice'=> $price_in * $gin->in_m3,
                                                
                                                'out_qty'=>$in->gout_qty,
                                                'out_m3'=>$in->gout_m3,
                                                'out_totprice'=>$price_in * $in->gout_m3,
            
                                                'doc_qty'=>$in->doc_qty,
                                                'doc_m3'=>$in->doc_m3,
                                                'doc_totprice'=>$price_in * $in->doc_m3,
                                                
                                                'ven_qty'=>$in->ven_qty,
                                                'ven_m3'=>$in->ven_m3,
                                                'ven_totprice'=>$price_in * $in->ven_m3
                                            ]);

                        }
                        else
                        {
                            //blm ada -> insert
                            $invoice = DB::table('receiptlogdetail_invoicing')
                                ->insert([
                                    'receiptlog_id'=> $id,
                                    'range_size'=>$in->range_size,
                                    'range_length'=>$in->range_length,
                                    'quality'=>$in->kwt,
                                    'sortimen'=>$sortimens,
                                    'kphtype'=>$in->kph_type,
                                    'price'=>$price_in,

                                    'in_qty'=> $gin->in_qty,
                                    'in_m3'=> $gin->in_m3,
                                    'in_totprice'=> $price_in * $gin->in_m3,
                                    
                                    'out_qty'=>$in->gout_qty,
                                    'out_m3'=>$in->gout_m3,
                                    'out_totprice'=>$price_in * $in->gout_m3,

                                    'doc_qty'=>$in->doc_qty,
                                    'doc_m3'=>$in->doc_m3,
                                    'doc_totprice'=>$price_in * $in->doc_m3,
                                    
                                    'ven_qty'=>$in->ven_qty,
                                    'ven_m3'=>$in->ven_m3,
                                    'ven_totprice'=>$price_in * $in->ven_m3
                                ]);
                        }
                        
                    }
                    

                }
        }

        return redirect()->to('receipt/hph/invoicing')->with('success','Generate Invoicing has been successfully.'); 
    }

    public function report_external($id)
    {   
        return Excel::download(new ExternalReceiptHPHreport($id), 'External Receipt HPH - '.$id.'.xlsx');
    }

    public function report_invoicing($id)
    {
        return Excel::download(new InvoicingReceiptHPHreport($id), 'Invoicing Receipt HPH - '.$id.'.xlsx');
    }

    public function import_vendor(Request $request)
    {
        try{
            $this->validate($request, [
                'import_vendor' => 'required|mimes:xls,xlsx'
            ]);

            $im = Excel::toCollection(new VendorReceiptHPHimport(), $request->file('import_vendor'));

            $total = count($im[0]);
            
            for($x = 0; $x < $total; $x++)
            {
               
                $h = DB::select('SELECT convert_quality(?) AS quality_id', [$im[0][$x][11]])[0];
                
                $idc = DB::select('SELECT convert_receiptlogID(?) as receiptlog_id', [$im[0][$x][0]])[0];

                $upt = ReceiptLogVendor::where('nextmap',$im[0][$x][1])
                    ->update([
                        // 'receiptlog_id' => $im[0][$x][0],
                        'receiptlog_id' => $idc->receiptlog_id,
                        'nextmap' => $im[0][$x][1],
                        'nokayu' => $im[0][$x][2],
                        'dia' => $im[0][$x][3],
                        'length' => $im[0][$x][4],
                        'height' => $im[0][$x][5],
                        'width' => $im[0][$x][6],
                        'm3' => $im[0][$x][7],
                        'nobarcode' => $im[0][$x][8],
                        'nopohon' => $im[0][$x][9],
                        'nopetak' => $im[0][$x][10],
                        'quality' => $h->quality_id,
                        'hjd' => $im[0][$x][12],
                        'price_po' => $im[0][$x][13],
                        'range_size' => $im[0][$x][14],
                        'range_length' => $im[0][$x][15]
                    ]);
            }

        }
        catch(\Exception $ex){
            return back()->with('warning', 'Select file type : .xls, xlsx required');
        }
        return redirect()->to('receipt/hph/vendor')->with('success', 'File vendor upload successfully.');
    }

    public function export_vendor(Request $request, $id)
    {
        // $id = id receipt hph
        $hph = ReceiptHPH::find($id);
        $pimid = $hph->pimid;

        $year = date('Y');
        $yr = Str::substr($year, 2, 2);
        $u = '1';
        $urutan = str_pad($u,4,'0',STR_PAD_LEFT); 

        $log = DB::table('receiptlog')
            ->where(['id_receipthph'=>$id,'pimid'=>$pimid,'is_delete'=>'0'])
            ->get();
        foreach($log as $l)
        {
            //get id tandaterima
            $tt_id = $l->tt_id;
            
            $tt = TT::find($tt_id);
            $p_qty = $tt->phisic_qty;
            $d_qty = $tt->doc_qty;

            $rv = ReceiptLogVendor::where('receiptlog_id',$l->id)->first();
            if(! $rv)
            {
                //not there
                //blm ada maka insert -> generate
                    $cek = ReceiptLogVendor::all();
                    if(! $cek->isEmpty())
                    {
                        //ada -> nextmap lanjut dari yg terakhir ada di tbl
                        $last_nextmap = ReceiptLogVendor::get()->last()->nextmap;
                        $n = Str::substr($last_nextmap, -4);
                        $nm = ltrim($n, 0);
                        $nmap = $nm + 1;

                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                // 'receiptlog_id' => $l->code,
                                'nextmap' => $yr.str_pad($nmap++,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogVendor::create($data);   
                        }
                    }
                    else
                    {
                        //kosong -> nextmap dimulai dari 1
                        
                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                // 'receiptlog_id' => $l->code,
                                'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogVendor::create($data);   
                        }
                    }
            }
            else
            {
                //sudah ada maka select
            }
            
        }

        //download all receiptlog yang id_receipthph = parameter
        return Excel::download(new VendorReceiptHPHexport($id), 'ReceiptHPH_Vendor_"'.$id.'".xlsx');
    }

    public function export_graderout(Request $request, $id)
    {
        // $id = id receipt hph
        $hph = ReceiptHPH::find($id);
        $pimid = $hph->pimid;

        $year = date('Y');
        $yr = Str::substr($year, 2, 2);
        $u = '1';
        $urutan = str_pad($u,4,'0',STR_PAD_LEFT); 

        $log = DB::table('receiptlog')
            ->where(['id_receipthph'=>$id,'pimid'=>$pimid,'is_delete'=>'0'])
            ->get();
        foreach($log as $l)
        {
            //get id tandaterima
            $tt_id = $l->tt_id;
            
            $tt = TT::find($tt_id);
            $p_qty = $tt->phisic_qty;
            $d_qty = $tt->doc_qty;

            $rv = ReceiptLogGraderOut::where('receiptlog_id',$l->id)->first();
            if(! $rv)
            {
                //not there
                //blm ada maka insert -> generate
                    $cek = ReceiptLogGraderOut::all();
                    if(! $cek->isEmpty())
                    {
                        //ada -> nextmap lanjut dari yg terakhir ada di tbl
                        $last_nextmap = ReceiptLogGraderOut::get()->last()->nextmap;
                        $n = Str::substr($last_nextmap, -4);
                        $nm = ltrim($n, 0);
                        $nmap = $nm + 1;

                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                'nextmap' => $yr.str_pad($nmap++,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogGraderOut::create($data);   
                        }
                    }
                    else
                    {
                        //kosong -> nextmap dimulai dari 1
                        
                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogGraderOut::create($data);   
                        }
                    }
            }
            else
            {
                //sudah ada maka select
            }
            
        }

        //download all receiptlog yang id_receipthph = parameter
        return Excel::download(new GraderOutReceiptHPHexport($id), 'ReceiptHPH_GraderOut_"'.$id.'".xlsx');
    }

    public function import_graderout(Request $request)
    {
        try{
            $this->validate($request, [
                'import_graderout' => 'required|mimes:xls,xlsx'
            ]);

            $im = Excel::toCollection(new GraderOutReceiptHPHimport(), $request->file('import_graderout'));

            $total = count($im[0]);
            
            for($x = 0; $x < $total; $x++)
            {
                $kwtt = DB::select('SELECT convert_quality(?) AS kwt_id', [$im[0][$x][3]])[0];
                $class = DB::select('SELECT convert_sortimen(?) AS class_id', [$im[0][$x][9]])[0];
                $kphtype = DB::select('SELECT convert_kphtype(?) AS kphtype_id', [$im[0][$x][53]])[0];

                $idc = DB::select('SELECT convert_receiptlogID(?) as receiptlog_id', [$im[0][$x][0]])[0];

                $upt = ReceiptLogGraderOut::where('nextmap',$im[0][$x][1])
                    ->update([
                        // 'receiptlog_id' => $im[0][$x][0],
                        'receiptlog_id' => $idc->receiptlog_id,
                        'nextmap' => $im[0][$x][1],
                        'nokayu' => $im[0][$x][2],
                        'kwt' => $kwtt->kwt_id,
                        'dia1' => $im[0][$x][4],
                        'dia2' => $im[0][$x][5],
                        'dia3' => $im[0][$x][6],
                        'dia4' => $im[0][$x][7],
                        'dia_avg' => $im[0][$x][8],
                        'class' => $class->class_id,
                        'heightfull' => $im[0][$x][10],
                        'widthfull' => $im[0][$x][11],
                        'lenfull' => $im[0][$x][12],
                        'lenmin' => $im[0][$x][13],
                        'lennett' => $im[0][$x][14],
                        'heighttrim' => $im[0][$x][15],
                        'widthtrim' => $im[0][$x][16],
                        'lengr' => $im[0][$x][17],
                        'lenkm' => $im[0][$x][18],
                        'lentrim' => $im[0][$x][19],
                        'heightmin' => $im[0][$x][20],
                        'heightnett' => $im[0][$x][21],
                        'widthmin' => $im[0][$x][22],
                        'widthnett' => $im[0][$x][23],
                        'p_len' => $im[0][$x][24],
                        'p_m3' => $im[0][$x][25],
                        'dia_gr' => $im[0][$x][26],
                        'nobarcode' => $im[0][$x][27],
                        'nopohon' => $im[0][$x][28],
                        'nopetak' => $im[0][$x][29],
                        'po_price' => $im[0][$x][30],
                        'gross_price'=> $im[0][$x][31],
                        'discount' => $im[0][$x][32],
                        'discount_value' => $im[0][$x][33],
                        'surcharges' => $im[0][$x][34],
                        'surcharges_value' => $im[0][$x][35],
                        'adj' => $im[0][$x][36],
                        'totprice' => $im[0][$x][37],
                        'dia1_teras' => $im[0][$x][38],
                        'dia2_teras' => $im[0][$x][39],
                        'dia3_teras' => $im[0][$x][40],
                        'dia4_teras' => $im[0][$x][41],
                        'diaavg_teras' => $im[0][$x][42],
                        'p_m3_teras' => $im[0][$x][43],
                        'po_price_teras' => $im[0][$x][44],
                        'gross_price_teras' => $im[0][$x][45],
                        'discount_teras' => $im[0][$x][46],
                        'discountvalue_teras' => $im[0][$x][47],
                        'surcharges_teras' => $im[0][$x][48],
                        'surcharges_value_teras' => $im[0][$x][49],
                        'adj_teras' => $im[0][$x][50],
                        'totprice_teras' => $im[0][$x][51],
                        'owner'=> $im[0][$x][52],
                        'kph_type' => $kphtype->kphtype_id,
                        'hjd' => $im[0][$x][54],
                        'range_size' => $im[0][$x][55],
                        'range_length' => $im[0][$x][56]
                        ]);
            }

        }
        catch(\Exception $ex){
            return back()->with('warning', 'Select file type : .xls, xlsx required');
        }
        return redirect()->to('receipt/hph/graderout')->with('success', 'File grader-out upload successfully.');
    }

    public function import_graderin(Request $request)
    {
        try{
            $this->validate($request, [
                'import_graderin' => 'required|mimes:xls,xlsx'
            ]);

            $im = Excel::toCollection(new GraderInReceiptHPHimport(), $request->file('import_graderin'));

            $total = count($im[0]);
            
            for($x = 0; $x < $total; $x++)
            {
                $kwtt = DB::select('SELECT convert_quality(?) AS kwt_id', [$im[0][$x][3]])[0];
                $class = DB::select('SELECT convert_sortimen(?) AS class_id', [$im[0][$x][9]])[0];
                $kphtype = DB::select('SELECT convert_kphtype(?) AS kphtype_id', [$im[0][$x][53]])[0];

                $idc = DB::select('SELECT convert_receiptlogID(?) as receiptlog_id', [$im[0][$x][0]])[0];

                $upt = ReceiptLogGraderIn::where('nextmap',$im[0][$x][1])
                    ->update([
                        // 'receiptlog_id' => $im[0][$x][0],
                        'receiptlog_id' => $idc->receiptlog_id,
                        'nextmap' => $im[0][$x][1],
                        'nokayu' => $im[0][$x][2],
                        'kwt' => $kwtt->kwt_id,
                        'dia1' => $im[0][$x][4],
                        'dia2' => $im[0][$x][5],
                        'dia3' => $im[0][$x][6],
                        'dia4' => $im[0][$x][7],
                        'dia_avg' => $im[0][$x][8],
                        'class' => $class->class_id,
                        'heightfull' => $im[0][$x][10],
                        'widthfull' => $im[0][$x][11],
                        'lenfull' => $im[0][$x][12],
                        'lenmin' => $im[0][$x][13],
                        'lennett' => $im[0][$x][14],
                        'heighttrim' => $im[0][$x][15],
                        'widthtrim' => $im[0][$x][16],
                        'lengr' => $im[0][$x][17],
                        'lenkm' => $im[0][$x][18],
                        'lentrim' => $im[0][$x][19],
                        'heightmin' => $im[0][$x][20],
                        'heightnett' => $im[0][$x][21],
                        'widthmin' => $im[0][$x][22],
                        'widthnett' => $im[0][$x][23],
                        'p_len' => $im[0][$x][24],
                        'p_m3' => $im[0][$x][25],
                        'dia_gr' => $im[0][$x][26],
                        'nobarcode' => $im[0][$x][27],
                        'nopohon' => $im[0][$x][28],
                        'nopetak' => $im[0][$x][29],
                        'po_price' => $im[0][$x][30],
                        'gross_price'=> $im[0][$x][31],
                        'discount' => $im[0][$x][32],
                        'discount_value' => $im[0][$x][33],
                        'surcharges' => $im[0][$x][34],
                        'surcharges_value' => $im[0][$x][35],
                        'adj' => $im[0][$x][36],
                        'totprice' => $im[0][$x][37],
                        'dia1_teras' => $im[0][$x][38],
                        'dia2_teras' => $im[0][$x][39],
                        'dia3_teras' => $im[0][$x][40],
                        'dia4_teras' => $im[0][$x][41],
                        'diaavg_teras' => $im[0][$x][42],
                        'p_m3_teras' => $im[0][$x][43],
                        'po_price_teras' => $im[0][$x][44],
                        'gross_price_teras' => $im[0][$x][45],
                        'discount_teras' => $im[0][$x][46],
                        'discountvalue_teras' => $im[0][$x][47],
                        'surcharges_teras' => $im[0][$x][48],
                        'surcharges_value_teras' => $im[0][$x][49],
                        'adj_teras' => $im[0][$x][50],
                        'totprice_teras' => $im[0][$x][51],
                        'owner'=> $im[0][$x][52],
                        'kph_type' => $kphtype->kphtype_id,
                        'hjd' => $im[0][$x][54],
                        'range_size' => $im[0][$x][55],
                        'range_length' => $im[0][$x][56]
                        ]);
            }

        }
        catch(\Exception $ex){
            return back()->with('warning', 'Select file type : .xls, xlsx required');
        }
        return redirect()->to('receipt/hph/graderin')->with('success', 'File grader-in upload successfully.');
    }

    public function export_graderin(Request $request, $id)
    {
        // $id = id receipt hph
        $hph = ReceiptHPH::find($id);
        $pimid = $hph->pimid;

        $year = date('Y');
        $yr = Str::substr($year, 2, 2);
        $u = '1';
        $urutan = str_pad($u,4,'0',STR_PAD_LEFT); 

        $log = DB::table('receiptlog')
            ->where(['id_receipthph'=>$id,'pimid'=>$pimid,'is_delete'=>'0'])
            ->get();
        foreach($log as $l)
        {
            //get id tandaterima
            $tt_id = $l->tt_id;
            
            $tt = TT::find($tt_id);
            $p_qty = $tt->phisic_qty;
            $d_qty = $tt->doc_qty;

            $rv = ReceiptLogGraderIn::where('receiptlog_id',$l->id)->first();
            if(! $rv)
            {
                //not there
                //blm ada maka insert -> generate
                    $cek = ReceiptLogGraderIn::all();
                    if(! $cek->isEmpty())
                    {
                        //ada -> nextmap lanjut dari yg terakhir ada di tbl
                        $last_nextmap = ReceiptLogGraderIn::get()->last()->nextmap;
                        $n = Str::substr($last_nextmap, -4);
                        $nm = ltrim($n, 0);
                        $nmap = $nm + 1;

                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                'nextmap' => $yr.str_pad($nmap++,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogGraderIn::create($data);   
                        }
                    }
                    else
                    {
                        //kosong -> nextmap dimulai dari 1
                        
                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogGraderIn::create($data);   
                        }
                    }
            }
            else
            {
                //sudah ada maka select
            }
            
        }

        //download all receiptlog yang id_receipthph = parameter
        return Excel::download(new GraderInReceiptHPHexport($id), 'ReceiptHPH_GraderIn_"'.$id.'".xlsx');
    }

    public function import_document(Request $request)
    {
        try{
            $this->validate($request, [
                'import_document' => 'required|mimes:xls,xlsx'
            ]);

            $im = Excel::toCollection(new DocumentReceiptHPHimport(), $request->file('import_document'));

            $total = count($im[0]);
            
            for($x = 0; $x < $total; $x++)
            {
                $quality = DB::select('SELECT convert_quality(?) AS quality_id', [$im[0][$x][11]])[0];
                $kphtype = DB::select('SELECT convert_kphtype(?) AS kphtype_id', [$im[0][$x][23]])[0];

                $idc = DB::select('SELECT convert_receiptlogID(?) as receiptlog_id', [$im[0][$x][0]])[0];

                $upt = ReceiptLogDocument::where('nextmap',$im[0][$x][1])
                    ->update([
                        'receiptlog_id' => $idc->receiptlog_id,
                        'nextmap' => $im[0][$x][1],
                        'nokayu' => $im[0][$x][2],
                        'dia' => $im[0][$x][3],
                        'length' => $im[0][$x][4],
                        'height' => $im[0][$x][5],
                        'width' => $im[0][$x][6],
                        'm3' => $im[0][$x][7],
                        'nobarcode' => $im[0][$x][8],
                        'nopohon' => $im[0][$x][9],
                        'nopetak' => $im[0][$x][10],
                        'quality' => $quality->quality_id,
                        'nokapling' => $im[0][$x][12],
                        'nobp' => $im[0][$x][13],
                        'umurkapling'=> $im[0][$x][14],
                        'kayuno2' => $im[0][$x][15],
                        'partaibp' => $im[0][$x][16],
                        'asaltahun' => $im[0][$x][17],
                        'price_po' => $im[0][$x][18],
                        'hjd' => $im[0][$x][19],
                        'hjdxm3' => $im[0][$x][20],
                        'discount' => $im[0][$x][21],
                        'value_discount' => $im[0][$x][22],
                        'kphtype' => $kphtype->kphtype_id,
                        'range_size' => $im[0][$x][24],
                        'range_length' => $im[0][$x][25]
                        ]);
            }

        }
        catch(\Exception $ex){
            return back()->with('warning', 'Select file type : .xls, xlsx required');
        }
        return redirect()->to('receipt/hph/document')->with('success', 'File doccument upload successfully.');
    }

    public function export_document(Request $request, $id)
    {
        // $id = id receipt hph
        $hph = ReceiptHPH::find($id);
        $pimid = $hph->pimid;

        $year = date('Y');
        $yr = Str::substr($year, 2, 2);
        $u = '1';
        $urutan = str_pad($u,4,'0',STR_PAD_LEFT); 

        $log = DB::table('receiptlog')
            ->where(['id_receipthph'=>$id,'pimid'=>$pimid,'is_delete'=>'0'])
            ->get();
        foreach($log as $l)
        {
            //get id tandaterima
            $tt_id = $l->tt_id;
            
            $tt = TT::find($tt_id);
            $p_qty = $tt->phisic_qty;
            $d_qty = $tt->doc_qty;

            $rv = ReceiptLogDocument::where('receiptlog_id',$l->id)->first();
            if(! $rv)
            {
                //not there
                //blm ada maka insert -> generate
                    $cek = ReceiptLogDocument::all();
                    if(! $cek->isEmpty())
                    {
                        //ada -> nextmap lanjut dari yg terakhir ada di tbl
                        $last_nextmap = ReceiptLogDocument::get()->last()->nextmap;
                        $n = Str::substr($last_nextmap, -4);
                        $nm = ltrim($n, 0);
                        $nmap = $nm + 1;

                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                'nextmap' => $yr.str_pad($nmap++,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogDocument::create($data);   
                        }
                    }
                    else
                    {
                        //kosong -> nextmap dimulai dari 1
                        
                        for($i = 1; $i <= $p_qty; $i++ )
                        {
                            $data = array(
                                'receiptlog_id' => $l->id,
                                'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                            );

                            $insert[] = $data; 
                            ReceiptLogDocument::create($data);   
                        }
                    }
            }
            else
            {
                //sudah ada maka select
            }
            
        }

        //download all receiptlog yang id_receipthph = parameter
        return Excel::download(new DocumentReceiptHPHexport($id), 'ReceiptHPH_Document_"'.$id.'".xlsx');

    }

    public function store(Request $request)
    {
        $request->validate([
            'codepim' => ['required'],
            'division' => ['required'],
            'applydate' => ['required']
        ]);
        
        //cek dulu di tabel udah ada yg pake TT itu atau blm
        // kalo udah ada, ga di save  //kalo blm ada, save
        // generte kode sebanyak TT

        $get_applydate = $request->get('applydate'); //2020-02-28
        $year = Str::substr($get_applydate, 2, 2);
        $yr = Str::substr($year, -2);
        $month = Str::substr($get_applydate, 5, 2);

        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        $ii = '1';
        $urutann = str_pad($ii,4,'0',STR_PAD_LEFT); 
       
        $ttid = $request->get('tt_id');
        $arr_ttid = explode(',', $ttid);

        foreach($arr_ttid as $tt_id)
        {
            $cek = DB::table('receiptlog')
                    ->where(['tt_id'=>$tt_id])
                    ->get();
            if($cek->isEmpty())
            {
                // has no records
               
                //code hph = 03 .log = 01 .non log = 02
                $h = ReceiptHPH::all();
                if(! $h->isEmpty())
                {
                    //di tabel sudah ada record
                    $hph = ReceiptHPH::get()->last()->code_hph;
                    $a = Str::substr($hph, -4);
                    $b = $a + 1;
                    $c = str_pad($b,4,'0',STR_PAD_LEFT); 
                    $codeHPH = 'F015/03/SFMP/'.$month.$yr.'/'.$c;
                }
                else
                {
                    // kosong
                    // F015/01/SFMP/blnthn/urutan
                    $codeHPH = 'F015/03/SFMP/'.$month.$yr.'/'.$urutan;
                }
                
                //code receiptlog
                $r = ReceiptLog::all();
                if(! $r->isEmpty())
                {
                    //di tabel sudah ada record
                    $log = ReceiptLog::get()->last()->code;
                    $aa = Str::substr($log, -4);
                    $bb = $aa + 1;
                    $cc = str_pad($bb,4,'0',STR_PAD_LEFT); 
                    $codeLOG = 'F015/01/SFMP/'.$month.$yr.'/'.$cc;
                }
                else
                {
                    //kosong
                    $codeLOG = 'F015/01/SFMP/'.$month.$yr.'/'.$urutann;
                }

                
                $rl = new ReceiptLog();
                // $rl->type_receipt = '2';
                $rl->code = $codeLOG;
                $rl->tt_id = $tt_id;
                $rl->pimid = $request->get('pimid');
                $rl->status = $request->get('status');
                $rl->itemgroup_id = $request->get('itemgroup_id');
                $rl->division = $request->get('division');
                $rl->applydate = $request->get('applydate');
                $rl->from_warehouse = $request->get('from_warehouse');
                $rl->to_warehouse = $request->get('to_warehouse');
                $rl->objective = $request->get('objective');
                $rl->ppc = $request->get('ppc');
                $rl->remarks = $request->get('remarks');
                $rl->perni = $request->get('perni');
                $rl->fakb = $request->get('fakb');
                $rl->unitsize = $request->get('unitsize');
                $rl->unitprice = $request->get('unitprice');
                $rl->source_price = $request->get('source_price');
                $rl->pph23 = $request->get('pph23');
                $rl->pph22 = $request->get('pph22');
                $rl->pph21 = $request->get('pph21');
                $rl->ppn = $request->get('ppn');
                $rl->trucking = $request->get('trucking');
                $rl->administration = $request->get('administration');
                $rl->lainlain = $request->get('lainlain');
                $rl->unit_trucking = $request->get('unit_trucking');
                $rl->save();
                if ($rl->save())
                {
                    //ambil receiptlog id yg baru saja disimpan
                    $l = ReceiptLog::get()->last()->id;

                    $rh = new ReceiptHPH();
                    $rh->code_hph = $codeHPH;
                    $rh->id_receiptlog = $l;
                    $rh->pimid = $request->get('pimid');
                    $rh->save();

                    if($rh->save())
                    {
                        $r_hph = ReceiptHPH::get()->last()->id;
                        // $r_log = ReceiptLog::find($l);
                        // $r_log->id_receipthph = $r_hph;
                        // $r_log->save();

                        $rrr = ReceiptLog::where('pimid', $request->get('pimid'))->get();
                        foreach($rrr as $rr)
                        {
                            DB::table('receiptlog')
                                ->where('id', $rr->id)
                                ->update(['id_receipthph' => $r_hph ]);
                        }

                    }
                }

                return redirect()->route('receipt.hph')->with('success', 'Data has been saved.');

            }
            else
            {
                //exist

            }

        }
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
               
                //return back()->with('warning', 'Name Grader-in and Location Grader-in required');
            }


            $graderin = $request->get('graderin');
            $location_graderin = $request->get('location_graderin');

            $noreceiptlog = $request->get('noreceiptlog');
           
            for($count = 0; $count < count($graderin); $count++)
            {
                $data = array(
                    'noreceiptlog' =>$noreceiptlog,
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

            $noreceiptlog = $request->get('noreceiptlog_graderout');
           
            for($count = 0; $count < count($graderout); $count++)
            {
                $data = array(
                    'noreceiptlog' =>$noreceiptlog,
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


}
