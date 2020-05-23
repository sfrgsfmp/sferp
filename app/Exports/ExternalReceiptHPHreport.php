<?php

namespace App\Exports;

use App\ReceiptLogInvoicing;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class ExternalReceiptHPHreport implements WithEvents,WithHeadings,FromCollection
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }


    public function collection()
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
                ->where('receiptlog.id_receipthph',$this->id)
                ->get();
        // return ReceiptLogInvoicing::where('receiptlog_id',$this->id)->get();
        return $rexternal;
    }

    public function registerEvents(): array{
        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        return [
            
            AfterSheet::class => function (AfterSheet $event) use ($styleArray){
                $event->sheet->getStyle('A1:CP1')->applyFromArray($styleArray);
            }
        ];
    }

    public function headings(): array{
        return['Receipt Log','NextMap','No Product', 'No Kayu (doc)', 'Dia (doc)', 'Length (doc)','Height (doc)', 'Width (doc)', 'M3 (doc)', 'Barcode (doc)', 'No Pohon (doc)', 'No Petak (doc)', 'No Kapling (doc)', 'No BP (doc)', 'Umur Kapling (doc)', 'Kayu no2 (doc)','Partai BP (doc)', 'Asal Tahun (doc)','Quality (doc)','KPH Type (doc)','Price HJD (doc)','Price PO (doc)', 'Range Size (doc)', 'Range Length (doc)','No Kayu (ven)','Dia (ven)','Length (ven)','Height (ven)','Width (ven)','M3 (ven)','Barcode (ven)','No Pohon (ven)','No Petak (ven)','Quality (ven)','KPH Type (ven)','Price HJD (ven)','Price PO (ven)','Range Size (ven)','Range Length (ven)','No Kayu (in)','Kwt (in)', 'Dia 1', 'Dia 2', 'Dia 3', 'Dia 4', 'Dia Avg', 'Class', 'HeightFull', 'WidthFull', 'LenFull','LenMin','LenNett','HeightTrim','WidthTrim','LenGr','LenKm','LenTrim','Height Min','Height Nett','Width Min','WidthNett','P Len','P M3', 'Dia Gr', 'NoBarcode', 'NoPohon','NoPetak','PO Price','GrossPrice','Discount%', 'Discont Value', 'Surcharges%', 'Surcharges Value', 'Adj', 'TotPrice', 'Dia1 teras', 'Dia2 teras', 'Dia3 teras', 'Dia4 teras', 'DiaAvg teras', 'P M3 teras', 'PO Price teras', 'GrossPrice teras', 'Discount% (teras)','Discount Value (teras)','%Surcharges (teras)','Surcharges Value (teras)','Adj% (teras)','TotPrice (teras)','Owner', 'KPH Type', 'Price HJD', 'Range Dia', 'Range Length'];
    }

}
