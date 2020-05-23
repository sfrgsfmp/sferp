<?php

namespace App\Exports;

use App\ReceiptLogGraderOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class GraderOutReceiptHPHexport implements WithHeadings,FromCollection
{
    protected $id;
    
    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // return ReceiptLogGraderOut::where('receiptlog_id',$this->id)->get();

        $hph = DB::table('receiptlog')
                ->leftJoin('receiptlogdetail_graderout', 'receiptlog.id', '=', 'receiptlogdetail_graderout.receiptlog_id')
                ->select('receiptlog.code', 'receiptlogdetail_graderout.nextmap','receiptlogdetail_graderout.nokayu',
                'receiptlogdetail_graderout.kwt','receiptlogdetail_graderout.dia1',
                'receiptlogdetail_graderout.dia2',
                'receiptlogdetail_graderout.dia3','receiptlogdetail_graderout.dia4',
                'receiptlogdetail_graderout.dia_avg',
                'receiptlogdetail_graderout.class',
                'receiptlogdetail_graderout.heightfull',
                'receiptlogdetail_graderout.widthfull',
                'receiptlogdetail_graderout.lenfull',
                'receiptlogdetail_graderout.lenmin',
                'receiptlogdetail_graderout.lennett','receiptlogdetail_graderout.heighttrim','receiptlogdetail_graderout.widthtrim','receiptlogdetail_graderout.lengr','receiptlogdetail_graderout.lenkm','receiptlogdetail_graderout.lentrim','receiptlogdetail_graderout.heightmin','receiptlogdetail_graderout.heightnett','receiptlogdetail_graderout.widthmin','receiptlogdetail_graderout.widthnett', 'receiptlogdetail_graderout.p_len','receiptlogdetail_graderout.p_m3', 'receiptlogdetail_graderout.dia_gr','receiptlogdetail_graderout.nobarcode','receiptlogdetail_graderout.nopohon','receiptlogdetail_graderout.nopetak','receiptlogdetail_graderout.po_price','receiptlogdetail_graderout.gross_price','receiptlogdetail_graderout.discount','receiptlogdetail_graderout.discount_value','receiptlogdetail_graderout.surcharges','receiptlogdetail_graderout.surcharges_value','receiptlogdetail_graderout.adj','receiptlogdetail_graderout.totprice','receiptlogdetail_graderout.dia1_teras','receiptlogdetail_graderout.dia2_teras','receiptlogdetail_graderout.dia3_teras','receiptlogdetail_graderout.dia4_teras','receiptlogdetail_graderout.diaavg_teras','receiptlogdetail_graderout.p_m3_teras','receiptlogdetail_graderout.po_price_teras','receiptlogdetail_graderout.gross_price_teras','receiptlogdetail_graderout.discount_teras','receiptlogdetail_graderout.discountvalue_teras','receiptlogdetail_graderout.surcharges_teras','receiptlogdetail_graderout.surcharges_value_teras','receiptlogdetail_graderout.adj_teras','receiptlogdetail_graderout.totprice_teras','receiptlogdetail_graderout.owner','receiptlogdetail_graderout.kph_type','receiptlogdetail_graderout.hjd','receiptlogdetail_graderout.range_size','receiptlogdetail_graderout.range_length')
                ->where('receiptlog.id_receipthph','=',$this->id)
                ->get();
        return $hph;
    }

    public function headings(): array{
        return['Receipt Log ID','Next Map','No Kayu','Kwt', 'Dia 1','Dia 2', 'Dia 3', 'Dia 4', 'Dia Avg', 'Class/Sortimen', 'Height Full', 'Width Full', 'Len Full', 'Len Min', 'Len Nett', 'Height Trim', 'Width Trim', 'Len Gr', 'Len Km' ,'Len Trim', 'Height Min','Height Nett','Width Min','Width Nett','P Len','P M3','Dia Gr','No Barcode','No Pohon','No Petak','PO Price','Gross Price','Discount%','Discount Value','Surcharges%','Surcharges Value','Adj(+/-)','TotPrice','Dia 1 (teras)','Dia 2 (teras)','Dia 3 (teras)','Dia 4 (teras)','Dia Avg (teras)', 'P M3 (teras)', 'PO Price (teras)', 'Gross Price (teras)', 'Discount% (teras)', 'Discount Value (teras)', 'Surcharges% Value','Surcharges Value (teras)', 'Adj(+/-) (teras)', 'TotPrice (teras)','Owner', 'KPHtype','HJD Price','Range Dia','Range Length'];
    }
}
