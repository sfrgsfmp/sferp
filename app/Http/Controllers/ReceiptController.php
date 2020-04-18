<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\TT;
use App\PIM;
use App\Warehouse;
use App\Company;
use App\Itemgroup;
use App\IndProv;
use App\IndCity;
use App\Objective;
use App\receiptgrader;
use Validator;
use App\Measurement;
use App\Vendor;
use App\PO;
use App\PO_detail;
use App\TPK;
use App\KPH;
use App\Species;
use App\Certificate;
use App\ReceiptLog;
use App\Specification;
use Illuminate\Support\Str;
use App\ReceiptLogVendor;
use App\ReceiptLogDocument;
use App\ReceiptLogGraderOut;
use App\ReceiptLogGraderIn;
use App\ReceiptLogExternal;
use App\ReceiptLogInvoicing;
use App\Remarks;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorReceiptExport;
use App\Imports\VendorReceiptImport;
use App\Exports\DocumentReceiptExport;
use App\Imports\DocumentReceiptImport;
use App\Exports\GraderOutReceiptExport;
use App\Imports\GraderOutReceiptImport;
use App\Exports\GraderInReceiptExport;
use App\Imports\GraderInReceiptImport;
use App\Exports\InvoicingReceiptReport;
use App\Exports\ExternalReceiptReport;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Itemproduct;
use App\SortimenDet;
use App\Tax;

class ReceiptController extends Controller
{

    public function create()
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
                    'receiptlogdetail_graderin.range_length as inrange_length'
                    )
        ->get(); 

        $receipts = ReceiptLog::tt();
        $receiptandtt = ReceiptLog::receiptlogandtts();
        // dd($receiptandtt);
        // ReceiptLog::where('is_delete','0')->get()

        return view('receipt.input')->with(['datas'=>Departemen::all(), 'tts'=>TT::where(['is_delete'=>'0'])->get(), 'pims'=>PIM::where(['is_delete'=>'0'])->get(),'warehouse'=>Warehouse::where(['is_delete'=>'0'])->get(), 'company'=>Company::all(), 'itemgroup'=>Itemgroup::where('is_delete','0')->get(), 'provinces'=>IndProv::all(), 'objective'=>Objective::where('is_delete','0')->get(), 'measurement'=>Measurement::where('is_delete','0')->get(), 'receipts'=>$receipts, 'receipt'=>ReceiptLog::where('is_delete','0')->get(), 'remarks'=>Remarks::where('is_delete','0')->get(), 'rvendors'=>ReceiptLogVendor::all(), 'rdocument'=>ReceiptLogDocument::all(), 'rgraderout'=>ReceiptLogGraderOut::all(), 'rgraderin'=>ReceiptLogGraderIn::all(), 'rgrader'=>receiptgrader::all(), 'rexternal'=>$rexternal, 'invoicing'=> ReceiptLogInvoicing::all(), 'taxs'=>Tax::all() ]);
    }


    public function view_external()
    {
        
        $rek = DB::table('receiptlogdetail_external')
                    ->join('receiptlogdetail_vendor', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_vendor.nextmap')
                    ->join('receiptlogdetail_graderin', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_graderin.nextmap')
                    ->join('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
                    ->join('receiptlog', 'receiptlogdetail_external.receiptlog_id', '=', 'receiptlog.id')
                    ->select('receiptlog.code','receiptlogdetail_external.nextmap as enextmap','receiptlogdetail_external.noproduct as enoproduct','receiptlogdetail_document.nokayu as dnokayu', 'receiptlogdetail_document.dia as ddia','receiptlogdetail_document.length as dlength','receiptlogdetail_document.height as dheight','receiptlogdetail_document.width as dwidth', 'receiptlogdetail_document.m3 as dm3','receiptlogdetail_document.nobarcode as dnobarcode', 'receiptlogdetail_document.nopohon as dnopohon', 'receiptlogdetail_document.nopetak as dnopetak','receiptlogdetail_document.quality as dquality','receiptlogdetail_document.nokapling as dnokapling','receiptlogdetail_document.nobp as dnobp','receiptlogdetail_document.umurkapling as dumurkapling','receiptlogdetail_document.kayuno2 as dkayuno2','receiptlogdetail_document.partaibp as dpartaibp','receiptlogdetail_document.asaltahun as dasaltahun','receiptlogdetail_vendor.nokayu as vnokayu', 'receiptlogdetail_vendor.dia as vdia', 'receiptlogdetail_vendor.length as vlength', 'receiptlogdetail_vendor.height as vheight', 'receiptlogdetail_vendor.width as vwidth', 'receiptlogdetail_vendor.m3 as vm3', 'receiptlogdetail_vendor.nobarcode as vnobarcode', 'receiptlogdetail_vendor.nopohon as vnopohon', 'receiptlogdetail_vendor.nopetak as vnopetak', 'receiptlogdetail_vendor.quality as vquality', 'receiptlogdetail_graderin.nokayu as innokayu', 'receiptlogdetail_graderin.kwt as inkwt', 'receiptlogdetail_graderin.dia1 as india1', 'receiptlogdetail_graderin.dia2 as india2', 'receiptlogdetail_graderin.dia3 as india3', 'receiptlogdetail_graderin.dia4 as india4', 'receiptlogdetail_graderin.dia_avg as indiaavg', 'receiptlogdetail_graderin.class as inclass', 'receiptlogdetail_graderin.heightfull as inheightfull', 'receiptlogdetail_graderin.widthfull as inwidthfull', 'receiptlogdetail_graderin.lenfull as inlenfull', 'receiptlogdetail_graderin.lenmin as inlenmin', 'receiptlogdetail_graderin.lennett as inlennett', 'receiptlogdetail_graderin.heighttrim as inheighttrim', 'receiptlogdetail_graderin.widthtrim as inwidthtrim','receiptlogdetail_graderin.lengr as inlengr', 'receiptlogdetail_graderin.lenkm as inlenkm', 'receiptlogdetail_graderin.lentrim as inlentrim', 'receiptlogdetail_graderin.heightmin as inheightmin', 'receiptlogdetail_graderin.heightnett as inheightnett', 'receiptlogdetail_graderin.widthmin as inwidthmin', 'receiptlogdetail_graderin.widthnett as inwidthnett', 'receiptlogdetail_graderin.p_len as inp_len', 'receiptlogdetail_graderin.p_m3 as inp_m3', 'receiptlogdetail_graderin.dia_gr as india_gr', 'receiptlogdetail_graderin.nobarcode as innobarcode', 'receiptlogdetail_graderin.nopohon as innopohon', 'receiptlogdetail_graderin.nopetak as innopetak', 'receiptlogdetail_graderin.po_price as inpo_price', 'receiptlogdetail_graderin.gross_price as ingross_price', 'receiptlogdetail_graderin.discount as indiscount', 'receiptlogdetail_graderin.discount_value as indiscountvalue', 'receiptlogdetail_graderin.surcharges as insurcharges', 'receiptlogdetail_graderin.surcharges_value as insurcharges_value', 'receiptlogdetail_graderin.adj as inadj', 'receiptlogdetail_graderin.dia1_teras as india1_teras', 'receiptlogdetail_graderin.dia2_teras as india2_teras', 'receiptlogdetail_graderin.dia3_teras as india3_teras', 'receiptlogdetail_graderin.dia4_teras as india4_teras', 'receiptlogdetail_graderin.diaavg_teras as indiaavg_teras', 'receiptlogdetail_graderin.p_m3_teras as inp_m3_teras', 'receiptlogdetail_graderin.po_price_teras as inpo_price_teras', 'receiptlogdetail_graderin.gross_price_teras as ingross_price_teras', 'receiptlogdetail_graderin.discount_teras as indiscountteras', 'receiptlogdetail_graderin.discountvalue_teras as indiscountvalue_teras', 'receiptlogdetail_graderin.surcharges_value_teras as insurcharges_value_teras', 'receiptlogdetail_graderin.adj_teras as inadj_teras')
                    // ->where([
                    //     ['receiptlogdetail_document.receiptlog_id', '=', $id],
                    //     ['receiptlogdetail_vendor.receiptlog_id', '=', $id],
                    //     ['receiptlogdetail_graderin.receiptlog_id', '=', $id],
                    //     ['receiptlogdetail_external.receiptlog_id', '=', $id],
                    // ])
                    // ->where('receiptlogdetail_external.receiptlog_id', '=', '1')
                    ->get(); 

                    
        $rexternal = DB::table('receiptlogdetail_external')
                    ->join('receiptlogdetail_vendor', 'receiptlogdetail_external.receiptlog_id', '=', 'receiptlogdetail_vendor.receiptlog_id')
                    ->select('receiptlogdetail_external.nextmap', 'receiptlogdetail_vendor.receiptlog_id')
                    // ->where('receiptlogdetail_external.receiptlog_id','=', $id)
                    ->get();

        
        // dd($id);
        return DataTables::of($rek)->toJson();
    }

    public function generate_itemcode($id)
    {    
        // $urutan = 1;
        // $urutanitem = 1;
        
        $rex = DB::table('receiptlogdetail_document')
            ->join('receiptlogdetail_vendor', 'receiptlogdetail_document.nextmap', '=', 'receiptlogdetail_vendor.nextmap')
            ->join('receiptlogdetail_graderin', 'receiptlogdetail_document.nextmap', '=', 'receiptlogdetail_graderin.nextmap')
            ->join('receiptlog', 'receiptlogdetail_document.receiptlog_id', '=', 'receiptlog.id')
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
            ->join('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
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
            
            return redirect()->to('/receipt/external')->with('success', 'Data has been generated');

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
                ->join('receiptlogdetail_document', 'receiptlogdetail_external.nextmap', '=', 'receiptlogdetail_document.nextmap')
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
            
            return redirect()->to('/receipt/external')->with('success', 'Data has been generated');
        }

    }

    public function generate_pricing($id)
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
        return redirect()->to('receipt/invoicing')->with('success','Generate Pricing from PO has been successfully.');
        
    }

    public function generate_invoicing($id)
    {
        //select masing2 tabel untuk tau diameter nya. lalu bikin range ukuran dari diameter tersebut. sebagai acuan ada ditabel sortimendet
       

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
            $sortimen = SortimenDet::where(['dia_det'=>$in->dia_avg,'range_size'=>$in->range_size])->pluck('sortimen_code')[0];

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
                $invoice = DB::table('receiptlogdetail_invoicing')
                        ->insert([
                            'receiptlog_id'=> $id,
                            'range_size'=>$in->range_size,
                            'range_length'=>$in->range_length,
                            'quality'=>$in->kwt,
                            'sortimen'=>$sortimen,
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

        return redirect()->to('receipt/invoicing')->with('success','Generate Invoicing from has been successfully.'); 

    }

    public function export_vendorreceipt(Request $request, $id)
    {
        //get jumlah batang di tabel TT
        $pimid = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('pimid');
        $pimno = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('pimno');
        
        $code_receiptlog = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code');
        $codereceipt = preg_replace('/[^a-zA-Z0-9:\']/','',$code_receiptlog);
        // dd($codereceipt);

        $tt_id = TT::where('pimid', $pimid)->pluck('id');
        $phisic_qty = TT::where('id',$tt_id)->pluck('phisic_qty');

        //cek dulu di tabel
        $year = date('Y');
        $yr = Str::substr($year, 2, 2);

        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        $vr = ReceiptLogVendor::all();
        if(! $vr->isEmpty()) //check
        {
            // //ada
            $code = ReceiptLogVendor::get()->last()->nextmap;
            $c = Str::substr($code, -4);
            $cr = ltrim($c, 0);
            
            $crl = $cr+1;

            foreach($vr as $v)
            {
                $receiptlogid = $v->receiptlog_id;
                if($id == $receiptlogid)
                {
                    
                    return back()->with('warning', 'Duplicate entry.');
                    //gaboleh sama id nya
                    //gabisa generate ulang dengan id yg sama
                }
                else
                {
                    for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
                    {
                       
                        $dataa = array(
                            'receiptlog_id' => $id,
                            'nextmap' => $yr.str_pad($crl++,4,'0',STR_PAD_LEFT),                    
                        );
        
                        $insert[] = $dataa; 
                        
                        ReceiptLogVendor::create($dataa);  
                       
                    }
                 
                    return Excel::download(new VendorReceiptExport($id), 'ReceiptLogVendor_"'.$codereceipt.'".xlsx');
                }
                
            }
        
        }
        else
        {
            //kosong
            
            for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
            { 
                $data = array(
                    'receiptlog_id' => $id,
                    'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                    
                );

                $insert_data[] = $data; 
                
                // ReceiptLogVendor::create($data);
                try
                {
                    DB::table('receiptlogdetail_vendor')->insert($data);
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

            return Excel::download(new VendorReceiptExport($id), 'ReceiptLogVendor_"'.$codereceipt.'".xlsx');
           
            // foreach($phisic_qty as $pqty)
            // {
            //     $data = array(
            //         'receiptlog_id' => $id,
            //         'nextmap' => $yr.str_pad($i++,4,'0',STR_PAD_LEFT)
            //     );
            //     $insert_data[] = $data;
            // }
            
            // for ($x = 1; $x <= $phisic_qty[0]; $x++) {
                
            //     $data = array(
            //         'data' => $x
            //     );
            //     $insert_data[] = $data;
            // }

        }
    }

    public function import(Request $request)
    {
        try{
            $this->validate($request, [
                'import_file' => 'required|mimes:xls,xlsx'
            ]);
            
            $im = Excel::toCollection(new VendorReceiptImport(), $request->file('import_file'));

            
            // dump($im);
            $total = count($im[0]);
            
            for($x = 0; $x < $total; $x++)
            {
               
                $h = DB::select('SELECT convert_quality(?) AS quality_id', [$im[0][$x][11]])[0];
                // dd($h);
                // var_dump($h->quality_id);
                // var_dump($h);/
                $upt = ReceiptLogVendor::where('nextmap',$im[0][$x][1])
                    ->update([
                        'receiptlog_id' => $im[0][$x][0],
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
            return back()->with('warning', 'Select file type: .xls, .xlsx required');
        }
        
        return redirect()->to('receipt/vendor')->with('success', 'File vendor upload successfully.');
       
    }

    public function export_documentreceipt(Request $request, $id)
    {
        //get jumlah batang di tabel TT
        $pimid = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('pimid');
        $pimno = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('pimno');
        
        $code_receiptlog = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code');
        $codereceipt = preg_replace('/[^a-zA-Z0-9:\']/','',$code_receiptlog);

        $tt_id = TT::where('pimid', $pimid)->pluck('id');
        $phisic_qty = TT::where('id',$tt_id)->pluck('phisic_qty');

        //cek dulu di tabel
        $year = date('Y');
        $yr = Str::substr($year, 2, 2);

        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        $vr = ReceiptLogDocument::all();
        if(! $vr->isEmpty()) //check
        {
            // //ada
            $code = ReceiptLogDocument::get()->last()->nextmap;
            $c = Str::substr($code, -4);
            $cr = ltrim($c, 0);
            
            $crl = $cr+1;

            foreach($vr as $v)
            {
                $receiptlogid = $v->receiptlog_id;
                if($id == $receiptlogid)
                {
                    
                    return back()->with('warning', 'Duplicate entry.');
                    //gaboleh sama id nya
                    //gabisa generate ulang dengan id yg sama
                }
                else
                {
                    for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
                    {
                       
                        $dataa = array(
                            'receiptlog_id' => $id,
                            'nextmap' => $yr.str_pad($crl++,4,'0',STR_PAD_LEFT),                    
                        );
        
                        $insert[] = $dataa; 
                        
                        ReceiptLogDocument::create($dataa);                         
                    }
                    
                    return Excel::download(new DocumentReceiptExport($id), 'ReceiptLogDocument_"'.$codereceipt.'".xlsx');
                }
            }

            

        }
        else
        {
            //kosong
            
            for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
            { 
                $data = array(
                    'receiptlog_id' => $id,
                    'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                    
                );

                $insert_data[] = $data; 
                
                ReceiptLogDocument::create($data);
                        
            }
            return Excel::download(new DocumentReceiptExport($id), 'ReceiptLogDocument_"'.$codereceipt.'".xlsx');

        }
    }

    public function import_documentreceipt(Request $request)
    {
        try
        {
            $this->validate($request, [
                'importdocument_file' => 'required|mimes:xls,xlsx'
            ]);

            $im = Excel::toArray(new DocumentReceiptImport(), $request->file('importdocument_file'));
            // dd($im);

            
            foreach($im[0] as $im)
            {
                $quality = DB::select('SELECT convert_quality(?) AS quality_id', [$im[11]])[0];
                $kphtype = DB::select('SELECT convert_kphtype(?) AS kphtype_id', [$im[23]])[0];
                ReceiptLogDocument::where('nextmap',$im[1])->update([
                    'receiptlog_id' => $im[0],
                    'nextmap' => $im[1],
                    'nokayu' => $im[2],
                    'dia' => $im[3],
                    'length' => $im[4],
                    'height' => $im[5],
                    'width' => $im[6],
                    'm3' => $im[7],
                    'nobarcode' => $im[8],
                    'nopohon' => $im[9],
                    'nopetak' => $im[10],
                    'quality' => $quality->quality_id,
                    'nokapling' => $im[12],
                    'nobp' => $im[13],
                    'umurkapling'=> $im[14],
                    'kayuno2' => $im[15],
                    'partaibp' => $im[16],
                    'asaltahun' => $im[17],
                    'price_po' => $im[18],
                    'hjd' => $im[19],
                    'hjdxm3' => $im[20],
                    'discount' => $im[21],
                    'value_discount' => $im[22],
                    'kphtype' => $kphtype->kphtype_id,
                    'range_size' => $im[24],
                    'range_length' => $im[25]
                ]);
            }
        }
        catch(\Exception $ex){
            return back()->with('warning', 'Select file type: .xls, .xlsx required');
        }

        return redirect()->to('receipt/document')->with('success', 'File document upload successfully.');
       
    }

    public function export_graderoutreceipt(Request $request,$id)
    {
        //get jumlah batang di tabel TT
        $pimid = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('pimid');
        $pimno = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('pimno');
        
        $code_receiptlog = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code');
        $codereceipt = preg_replace('/[^a-zA-Z0-9:\']/','',$code_receiptlog);
        $tt_id = TT::where('pimid', $pimid)->pluck('id');
        $phisic_qty = TT::where('id',$tt_id)->pluck('phisic_qty');

        //cek dulu di tabel
        $year = date('Y');
        $yr = Str::substr($year, 2, 2);

        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        $vr = ReceiptLogGraderOut::all();
        if(! $vr->isEmpty()) //check
        {
            // //ada
            $code = ReceiptLogGraderOut::get()->last()->nextmap;
            $c = Str::substr($code, -4);
            $cr = ltrim($c, 0);
            
            $crl = $cr+1;
            foreach($vr as $v)
            {
                $receiptlogid = $v->receiptlog_id;
                if($id == $receiptlogid)
                {
                    
                    return back()->with('warning', 'Duplicate entry.');
                    //gaboleh sama id nya
                    //gabisa generate ulang dengan id yg sama
                }
                else
                {
                    for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
                    {
                        $dataa = array(
                            'receiptlog_id' => $id,
                            'nextmap' => $yr.str_pad($crl++,4,'0',STR_PAD_LEFT),                    
                        );
                        $insert[] = $dataa; 
                        ReceiptLogGraderOut::create($dataa);                         
                    }
                    
                    return Excel::download(new GraderOutReceiptExport($id), 'ReceiptLogGraderOut_"'.$codereceipt.'".xlsx');
                }
            }

            

        }
        else
        {
            //kosong
            for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
            { 
                $data = array(
                    'receiptlog_id' => $id,
                    'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                );

                $insert_data[] = $data; 
                ReceiptLogGraderOut::create($data);
            }
            return Excel::download(new GraderOutReceiptExport($id), 'ReceiptLogGraderOut_"'.$codereceipt.'".xlsx');

        }
    }

    public function importgraderout(Request $request)
    {
        try
        {
            $this->validate($request, [
                'importgraderout_file' => 'required|mimes:xls,xlsx'
            ]);

            $im = Excel::toCollection(new GraderOutReceiptImport(), $request->file('importgraderout_file'));
            // dd($im[0]);
            $total = count($im[0]);
            
            // for($x = 0; $x < $total; $x++)
            foreach($im[0] as $im)
            {
                // $nb = DB::select('SELECT nb_seances_archivees() AS nb')[0]->nb;
                $kwtt = DB::select('SELECT convert_quality(?) AS kwt_id', [$im[3]])[0];
               
                $class = DB::select('SELECT convert_sortimen(?) AS class_id', [$im[9]])[0];
                $kphtype = DB::select('SELECT convert_kphtype(?) AS kphtype_id', [$im[53]])[0];
                $graderout = ReceiptLogGraderOut::where('nextmap',$im[1])->update([
                    'receiptlog_id' => $im[0],
                    'nextmap' => $im[1],
                    'nokayu' => $im[2],
                    'kwt' => $kwtt->kwt_id,
                    'dia1' => $im[4],
                    'dia2' => $im[5],
                    'dia3' => $im[6],
                    'dia4' => $im[7],
                    'dia_avg' => $im[8],
                    'class' => $class->class_id,
                    'heightfull' => $im[10],
                    'widthfull' => $im[11],
                    'lenfull' => $im[12],
                    'lenmin' => $im[13],
                    'lennett' => $im[14],
                    'heighttrim' => $im[15],
                    'widthtrim' => $im[16],
                    'lengr' => $im[17],
                    'lenkm' => $im[18],
                    'lentrim' => $im[19],
                    'heightmin' => $im[20],
                    'heightnett' => $im[21],
                    'widthmin' => $im[22],
                    'widthnett' => $im[23],
                    'p_len' => $im[24],
                    'p_m3' => $im[25],
                    'dia_gr' => $im[26],
                    'nobarcode' => $im[27],
                    'nopohon' => $im[28],
                    'nopetak' => $im[29],
                    'po_price' => $im[30],
                    'gross_price'=> $im[31],
                    'discount' => $im[32],
                    'discount_value' => $im[33],
                    'surcharges' => $im[34],
                    'surcharges_value' => $im[35],
                    'adj' => $im[36],
                    'totprice' => $im[37],
                    'dia1_teras' => $im[38],
                    'dia2_teras' => $im[39],
                    'dia3_teras' => $im[40],
                    'dia4_teras' => $im[41],
                    'diaavg_teras' => $im[42],
                    'p_m3_teras' => $im[43],
                    'po_price_teras' => $im[44],
                    'gross_price_teras' => $im[45],
                    'discount_teras' => $im[46],
                    'discountvalue_teras' => $im[47],
                    'surcharges_teras' => $im[48],
                    'surcharges_value_teras' => $im[49],
                    'adj_teras' => $im[50],
                    'totprice_teras' => $im[51],
                    'owner'=> $im[52],
                    'kph_type' => $kphtype->kphtype_id,
                    'hjd' => $im[54],
                    'range_size' => $im[55],
                    'range_length' => $im[56]
                ]);
            }
            
        }
        catch(\Exception $ex){
            return back()->with('warning', 'Select file type: .xls, .xlsx required');
        }
        return redirect()->to('receipt/graderout')->with('success', 'File Grader-out upload successfully.');
       
    }

    public function export_graderinreceipt(Request $request, $id)
    {
        //get jumlah batang di tabel TT
        $pimid = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('pimid');
        $pimno = PIM::where(['id'=>$pimid, 'is_delete'=>'0'])->pluck('pimno');
        
        $code_receiptlog = ReceiptLog::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code');
        $codereceipt = preg_replace('/[^a-zA-Z0-9:\']/','',$code_receiptlog);
        $tt_id = TT::where('pimid', $pimid)->pluck('id');
        $phisic_qty = TT::where('id',$tt_id)->pluck('phisic_qty');


        //cek dulu di tabel
        $year = date('Y');
        $yr = Str::substr($year, 2, 2);

        $i = '1';
        $urutan = str_pad($i,4,'0',STR_PAD_LEFT); 

        $vr = ReceiptLogGraderIn::all();
        if(! $vr->isEmpty()) //check
        {
            // //ada
            $code = ReceiptLogGraderIn::get()->last()->nextmap;
            $c = Str::substr($code, -4);
            $cr = ltrim($c, 0);
            
            $crl = $cr+1;
            foreach($vr as $v)
            {
                $receiptlogid = $v->receiptlog_id;
                if($id == $receiptlogid)
                {
                    
                    return back()->with('warning', 'Duplicate entry.');
                    //gaboleh sama id nya
                    //gabisa generate ulang dengan id yg sama
                }
                else
                {
                    for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
                    {
                        $dataa = array(
                            'receiptlog_id' => $id,
                            'nextmap' => $yr.str_pad($crl++,4,'0',STR_PAD_LEFT),                    
                        );
                        $insert[] = $dataa; 
                        ReceiptLogGraderIn::create($dataa);                         
                    }
                    
                    return Excel::download(new GraderInReceiptExport($id), 'ReceiptLogGraderIn_"'.$codereceipt.'".xlsx');
                }
            }

            

        }
        else
        {
            //kosong
            for($urutan = 1; $urutan <= $phisic_qty[0]; $urutan++)
            { 
                $data = array(
                    'receiptlog_id' => $id,
                    'nextmap' => $yr.str_pad($urutan,4,'0',STR_PAD_LEFT),
                );

                $insert_data[] = $data; 
                ReceiptLogGraderIn::create($data);
            }
            return Excel::download(new GraderInReceiptExport($id), 'ReceiptLogGraderIn_"'.$codereceipt.'".xlsx');
        }
    }

    public function importgraderin(Request $request)
    {
        try
        {
            $this->validate($request, [
                'importgraderin_file' => 'required|mimes:xls,xlsx'
            ]);

            $im= Excel::toCollection(new GraderInReceiptImport(), $request->file('importgraderin_file'));
            
            $total = count($im[0]);
            // dd($imin[0]);
            // for($x = 0; $x < $total; $x++)
            foreach($im[0] as $imin)
            {
                // $h = DB::select('SELECT convert_quality(?) AS quality_id', [$im[0][$x][11]])[0];
                $kwt = DB::select('SELECT convert_quality(?) AS kwt_id', [$imin[3]])[0];
                $class = DB::select('SELECT convert_sortimen(?) AS class_id', [$imin[9]])[0];
                // var_dump($class[0]);
                $gin = ReceiptLogGraderIn::where('nextmap',$imin[1])->update([
                    'receiptlog_id' => $imin[0],
                    'nextmap' => $imin[1],
                    'nokayu' => $imin[2],
                    'kwt' => $kwt->kwt_id,
                    'dia1' => $imin[4],
                    'dia2' => $imin[5],
                    'dia3' => $imin[6],
                    'dia4' => $imin[7],
                    'dia_avg' => $imin[8],
                    'class' => $class->class_id,
                    'heightfull' => $imin[10],
                    'widthfull' => $imin[11],
                    'lenfull' =>$imin[12],
                    'lenmin' => $imin[13],
                    'lennett' => $imin[14],
                    'heighttrim' => $imin[15],
                    'widthtrim' => $imin[16],
                    'lengr' => $imin[17],
                    'lenkm' => $imin[18],
                    'lentrim' => $imin[19],
                    'heightmin' => $imin[20],
                    'heightnett' => $imin[21],
                    'widthmin' => $imin[22],
                    'widthnett' => $imin[23],
                    'p_len' => $imin[24],
                    'p_m3' => $imin[25],
                    'dia_gr' => $imin[26],
                    'nobarcode' => $imin[27],
                    'nopohon' => $imin[28],
                    'nopetak' => $imin[29],
                    'po_price' => $imin[30],
                    'gross_price'=> $imin[31],
                    'discount' => $imin[32],
                    'discount_value' => $imin[33],
                    'surcharges' => $imin[34],
                    'surcharges_value' => $imin[35],
                    'adj' => $imin[36],
                    'totprice' => $imin[37],
                    'dia1_teras' => $imin[38],
                    'dia2_teras' => $imin[39],
                    'dia3_teras' => $imin[40],
                    'dia4_teras' => $imin[41],
                    'diaavg_teras' => $imin[42],
                    'p_m3_teras' => $imin[43],
                    'po_price_teras' => $imin[44],
                    'gross_price_teras' => $imin[45],
                    'discount_teras' => $imin[46],
                    'discountvalue_teras' => $imin[47],
                    'surcharges_teras' => $imin[48],
                    'surcharges_value_teras' =>$imin[49],
                    'adj_teras' => $imin[50],
                    'totprice_teras' => $imin[51],
                    'owner'=> $imin[52],
                    'kph_type' => $imin[53],
                    'hjd' => $imin[54],
                    'range_size' => $imin[55],
                    'range_length' => $imin[56]
                ]);
                
            }

        }
        catch(\Exception $ex){
            return back()->with('warning', 'Select file type: .xls, .xlsx required');
        }
        
        
        return redirect()->to('receipt/graderin')->with('success', 'File Grader-in upload successfully.');
        
    }

    public function report_invoicing($id)
    {
        
        $inv = ReceiptLog::where('id',$id)->pluck('code')[0];
        
        return Excel::download(new InvoicingReceiptReport($id), 'Invoicing Receipt.xlsx');
        
    }

    public function report_external($id)
    {
        return Excel::download(new ExternalReceiptReport($id), 'External Receipt.xlsx');
    }


    public function select_receiptlog($id)
    {
        $code = ReceiptLog::where('id',$id)->pluck('code');
        return json_encode(array($code, $id));
    }

    public function selectpim($id)
    {
        $tt_id = TT::where('pimid', $id)->pluck('id');
        $tt_code = TT::where('id', $tt_id)->pluck('code_tt');
        $tt_no = TT::where('id', $tt_id)->pluck('tt_no');
        $skskb_no = TT::where('id',$tt_id)->pluck('no_document');
        $skskb_qty = TT::where('id',$tt_id)->pluck('doc_qty');
        $skskb_m3 = TT::where('id',$tt_id)->pluck('docm3');

        $code_pim = PIM::where('id',$id)->pluck('code_pim');
        $pimno = PIM::where('id',$id)->pluck('pimno');

        $po_id = PIM::where('id', $id)->pluck('po_reference');
        $po = PO::where('id',$po_id)->pluck('code');

        $prm = PIM::where('id', $id)->pluck('noprocurement');
        $vendor_id = PIM::where('id', $id)->pluck('vendor_id');
        $vendor_name = Vendor::where('id',$vendor_id)->pluck('name_vendor');
        $tpk_id = PIM::where('id',$id)->pluck('tpk_id');
        $tpkname = TPK::where('id',$tpk_id)->pluck('name_tpk');

        //kph = concession
        $kphid = PIM::where('id', $id)->pluck('kph_id');
        $kph = KPH::where('id',$kphid)->pluck('name_kph');

        $doc = PO::where('id',$po_id)->pluck('document');
        $measu = PO::where('id',$po_id)->pluck('measurement');
        $npwp = PO::where('id',$po_id)->pluck('npwp');
        $incoterms = PO::where('id',$po_id)->pluck('incoterms');
        $noparcel = PIM::where('id',$id)->pluck('noparcel');
        $notransport = PIM::where('id', $id)->pluck('notransport');
        $speciesid = PO::where('id', $po_id)->pluck('speciess');
        $species = Species::where('id', $speciesid)->pluck('name');

        $certificate_id = PO::where('id',$po_id)->pluck('certificate');
        $certificate = Certificate::where('id',$certificate_id)->pluck('cert_name');

        return json_encode(array($tt_id, $tt_code, $id, $code_pim, $pimno, $po_id, $po, $prm, $vendor_id, $vendor_name, $tpk_id, $tpkname, $kph, $doc, $measu, $npwp, $incoterms, $tt_no, $noparcel, $notransport, $speciesid, $species, $skskb_no, $skskb_qty, $skskb_m3, $certificate));
    }

    public function store(Request $request)
    {
        $request->validate([
            'applydate' => ['required'],
            'division' => ['required'],
            // 'ppc' => ['required']
        ]);
        // FORMAT CODE RECEIPT LOLG
        // F015/01/SFMP/0819/855

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
            $codereceipt = 'F015/01/SFMP/'.$month.$yr.'/'.$crlg;

        }
        else
        {
            //kosong
            // F015/01/SFMP/blnthn/urutan
            $codereceipt = 'F015/01/SFMP/'.$month.$yr.'/'.$urutan;
        }

        $r = new ReceiptLog();
        $r->code = $codereceipt;
        $r->pimid = $request->get('pimid');
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
        $r->save();
        
        return redirect()->route('receipt.create')->with('success', 'Data has been saved.');
    }

    public function viewGeneral($id)
    {
        $pimid = ReceiptLog::where('id',$id)->pluck('pimid');
        $pim = PIM::where('id', $pimid)->pluck('code_pim');
        $pimno = PIM::where('id', $pimid)->pluck('pimno');
        $status = ReceiptLog::where('id',$id)->pluck('status');
        $itemgroup_id = ReceiptLog::where('id',$id)->pluck('itemgroup_id');
        // $noparcel = PIM::where('id',$pimid)->pluck('noparcel');
        $po_id = PIM::where('id', $pimid)->pluck('po_reference');
        $po = PO::where('id',$po_id)->pluck('code');
        
        $tt_id = TT::where('pimid', $pimid)->pluck('id');
        $tt_code = TT::where('id', $tt_id)->pluck('code_tt');
        $tt_no = TT::where('id', $tt_id)->pluck('tt_no');

        $prm = PIM::where('id', $pimid)->pluck('noprocurement');
        $vendor_id = PIM::where('id', $pimid)->pluck('vendor_id');
        $vendor_name = Vendor::where('id',$vendor_id)->pluck('name_vendor');
        $tpk_id = PIM::where('id',$pimid)->pluck('tpk_id');
        $tpkname = TPK::where('id',$tpk_id)->pluck('name_tpk');
        $tpkname = count($tpkname) == '0' ? '': $tpkname; 
        
        //kph = concession
        $kphid = PIM::where('id', $pimid)->pluck('kph_id');
        $kph = KPH::where('id',$kphid)->pluck('name_kph');
        $kph = count($kph) == '0' ? '': $kph; 

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
        $perni = ReceiptLog::where('id',$id)->pluck('perni');
        $fakb = ReceiptLog::where('id',$id)->pluck('fakb');

        $skskb_no = TT::where('id',$tt_id)->pluck('no_document');
        $skskb_qty = TT::where('id',$tt_id)->pluck('doc_qty');
        $skskb_m3 = TT::where('id',$tt_id)->pluck('docm3');
        $applydate = ReceiptLog::where('id',$id)->pluck('applydate');

        $warehousefromid = Receiptlog::where('id',$id)->pluck('from_warehouse');
        $warehousefrom = Warehouse::where('id',$warehousefromid)->pluck('warehouse_name');
        $warehousetoid = ReceiptLog::where('id',$id)->pluck('to_warehouse');
        $warehouseto = Warehouse::where('id',$warehousetoid)->pluck('warehouse_name');
        $objectiveid = ReceiptLog::where('id',$id)->pluck('objective');
        $objective = Objective::where('id',$objectiveid)->pluck('objective_name');
        $ppc = ReceiptLog::where('id',$id)->pluck('ppc');
        $remarksid = ReceiptLog::where('id',$id)->pluck('remarks');
        $remarks = Remarks::where('id',$remarksid)->pluck('name');
        
        //
        $division = ReceiptLog::where('id', $id)->pluck('division');
        $name_beneficiary = Company::where('code', $division)->pluck('name');
        $address_beneficiary = Company::where('code', $division)->pluck('address');
        $contactperson_beneficiary = Company::where('code', $division)->pluck('contact_person');
        
        $code_beneficiary = Company::where('code', $division)->pluck('code');
        $id_division_beneficiary = Company::where('code', $division)->pluck('id');

        $province_beneficiary_id = Company::where('code', $division)->pluck('province_id');
        $name_province = IndProv::where('id', $province_beneficiary_id)->pluck('name');

        $city_beneficiary_id = Company::where('code', $division)->pluck('city_id');
        $name_city = IndCity::where('id', $city_beneficiary_id)->pluck('name');
        $unitsizeid = ReceiptLog::where('id',$id)->pluck('unitsize');
        $unitsize = Measurement::where('id',$unitsizeid)->pluck('measurement_name');
        $unitpriceid = ReceiptLog::where('id',$id)->pluck('unitprice');
        $unitprice = Measurement::where('id',$unitpriceid)->pluck('measurement_name');
        $sourceprice = ReceiptLog::where('id',$id)->pluck('source_price');

        $pph23_id = ReceiptLog::where('id',$id)->pluck('pph23');
        $pph23 = Tax::where('id',$pph23_id)->pluck('name');

        $pph22_id = ReceiptLog::where('id',$id)->pluck('pph22');
        $pph22 = Tax::where('id',$pph22_id)->pluck('name');

        $pph21_id = ReceiptLog::where('id',$id)->pluck('pph21');
        $pph21 = Tax::where('id',$pph21_id)->pluck('name');

        $ppn_id = ReceiptLog::where('id',$id)->pluck('ppn');
        $ppn = Tax::where('id',$ppn_id)->pluck('name');
        $trucking = ReceiptLog::where('id',$id)->pluck('trucking');
        $admn = ReceiptLog::where('id',$id)->pluck('administration');
        $lain = ReceiptLog::where('id',$id)->pluck('lainlain');
        $unitrucking_id = ReceiptLog::where('id',$id)->pluck('unit_trucking');
        $unitrucking = Measurement::where('id',$unitrucking_id)->pluck('measurement_code');

        return json_encode(array($tt_code,$pim, $pimno, $status, $itemgroup_id, $division, $applydate, $warehousefrom, $warehouseto,$objective,$ppc, $remarks,$po, $prm, $vendor_name,$tpkname,$kph,$code_beneficiary,$name_beneficiary,$address_beneficiary,$name_province,$name_city,$species,$skskb_no,$skskb_qty,$skskb_m3,$noparcel,$certificate,$perni,$fakb,$measu,$tt_no,$notransport,$doc,$unitsize,$unitprice,$npwp,$incoterms,$sourceprice,$pph23,$pph22,$pph21,$ppn,$trucking,$admn,$lain,$unitrucking));
    }

    public function editgeneral($id)
    {
        $pimid = ReceiptLog::where('id',$id)->pluck('pimid');
        $pim = PIM::where('id',$pimid)->pluck('code_pim')[0];
        $no_pim = PIM::where('id',$pimid)->pluck('pimno')[0];
        $po_id = PIM::where('id', $pimid)->pluck('po_reference');
        $po = PO::where('id',$po_id)->pluck('code');
        // $po = json_encode($po);
        // $po = preg_replace("_\\\_", "", $po);
        // $po = ltrim($po, '["');
        // $po = rtrim($po, '"]');
        
        $tt_id = TT::where('pimid', $pimid)->pluck('id');

        $tt_code = TT::where('id', $tt_id)->pluck('code_tt');
        // $tt_code = json_encode($tt_code);
        // $tt_code = preg_replace("_\\\_", "", $tt_code);
        // $tt_code = preg_replace('(["])', ' ', $tt_code);
        // dd($tt_code[0]);
        // $tt_code = preg_replace('/[^a-zA-Z0-9:\']/', '',$tt_code);

        $tt_no = TT::where('id', $tt_id)->pluck('tt_no');

        $prm = PIM::where('id', $pimid)->pluck('noprocurement');
        $vendor_id = PIM::where('id', $pimid)->pluck('vendor_id');
        $vendor_name = Vendor::where('id',$vendor_id)->pluck('name_vendor');
        $tpk_id = PIM::where('id',$pimid)->pluck('tpk_id');
        $tpkname = TPK::where('id',$tpk_id)->pluck('name_tpk');
        $tpkname = count($tpkname) == '0' ? '': $tpkname[0]; 
        // dd($tpkname);

        //kph = concession
        $kphid = PIM::where('id', $pimid)->pluck('kph_id');
        $kph = KPH::where('id',$kphid)->pluck('name_kph');
        $kph = count($kph) == '0' ? '': $kph[0]; 

        $doc = PO::where('id',$po_id)->pluck('document');
        // $doc = ltrim($doc, '["');
        // $doc = rtrim($doc, '"]');

        $measu = PO::where('id',$po_id)->pluck('measurement');
        $npwp = PO::where('id',$po_id)->pluck('npwp');
        $incoterms = PO::where('id',$po_id)->pluck('incoterms');
        $noparcel = PIM::where('id',$pimid)->pluck('noparcel');
        $notransport = PIM::where('id', $pimid)->pluck('notransport');
        $speciesid = PO::where('id', $po_id)->pluck('speciess');
        $species = Species::where('id', $speciesid)->pluck('name');

        $certificate_id = PO::where('id',$po_id)->pluck('certificate');
        $certificate = Certificate::where('id',$certificate_id)->pluck('cert_name');

        $skskb_no = TT::where('id',$tt_id)->pluck('no_document');
        $skskb_qty = TT::where('id',$tt_id)->pluck('doc_qty');
        $skskb_m3 = TT::where('id',$tt_id)->pluck('docm3');

        //
        $division = ReceiptLog::where('id', $id)->pluck('division');
        $name_beneficiary = Company::where('code', $division)->pluck('name');
        $address_beneficiary = Company::where('code', $division)->pluck('address');
        $contactperson_beneficiary = Company::where('code', $division)->pluck('contact_person');
        
        $code_beneficiary = Company::where('code', $division)->pluck('code');
        $id_division_beneficiary = Company::where('code', $division)->pluck('id');

        $province_beneficiary_id = Company::where('code', $division)->pluck('province_id');
        $name_province = IndProv::where('id', $province_beneficiary_id)->pluck('name');

        $city_beneficiary_id = Company::where('code', $division)->pluck('city_id');
        $name_city = IndCity::where('id', $city_beneficiary_id)->pluck('name');

        // $tt_codes = json_decode($tt_code, true);

        return view('receipt.edit')->with(['datas'=>Departemen::all(), 'tts'=>TT::where(['is_delete'=>'0'])->get(), 'pims'=>PIM::where(['is_delete'=>'0'])->get(),'warehouse'=>Warehouse::where(['is_delete'=>'0'])->get(), 'company'=>Company::all(), 'itemgroup'=>Itemgroup::where('is_delete','0')->get(), 'provinces'=>IndProv::all(), 'objective'=>Objective::where('is_delete','0')->get(), 'measurement'=>Measurement::where('is_delete','0')->get(), 'receipts'=>ReceiptLog::where(['is_delete'=>'0'])->get(), 'receipt'=>ReceiptLog::find($id), 'remarks'=>Remarks::where('is_delete','0')->get(), 'po_id'=>$po_id, 'po'=>$po[0], 'prm'=>$prm[0], 'vendor_id'=>$vendor_id[0], 'vendor_name'=>$vendor_name[0], 'tpk_id'=>$tpk_id[0], 'tpkname'=>$tpkname, 'kph'=>$kph, 'doc'=>$doc[0], 'measu'=>$measu[0], 'npwp'=>$npwp[0], 'incoterms'=>$incoterms[0], 'noparcel'=>$noparcel[0], 'notransport'=>$notransport[0], 'speciesid'=>$speciesid, 'species'=>$species[0], 'certificateid'=>$certificate_id[0], 'certificate'=>$certificate[0], 'tt_id'=>$tt_id[0], 'tt_code'=>$tt_code[0],'tt_no'=>$tt_no[0], 'skskb_no'=>$skskb_no[0], 'skskb_qty'=>$skskb_qty[0], 'skskb_m3'=>$skskb_m3[0], 'name_beneficiary'=>$name_beneficiary[0], 'address_beneficiary'=>$address_beneficiary[0], 'contactperson_beneficiary'=>$contactperson_beneficiary, 'name_province'=>$name_province[0], 'name_city'=>$name_city[0], 'rvendors'=>ReceiptLogVendor::all(), 'rdocument'=>ReceiptLogDocument::all(), 'rgrader'=>receiptgrader::all(), 'rgraderout'=>ReceiptLogGraderOut::all(), 'rgraderin'=>ReceiptLogGraderIn::all(), 'taxs'=>Tax::all(),'pim'=>$pim, 'no_pim'=>$no_pim, 'invoicing'=> ReceiptLogInvoicing::all() ]);
    }

    public function updategeneral(Request $request, $id)
    {
        $request->validate([
            'applydate' => ['required'],
            'division' => ['required'],
            'tt_code' => ['required'],
            // 'ppc' => ['required']
        ]);


        $r = ReceiptLog::find($id);
        $r->code = $request->get('code');
        $r->pimid = $request->get('pimid');
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
        $r->save();

        return redirect()->route('receipt.create')->with('success', 'Data has been updated.');
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

    public function deletegrader($id)
    {
        $g = receiptgrader::find($id);
        $g->delete();
        return back()->with('success', 'Data has been deleted');
    }
}
