<?php

namespace App\Exports;

use App\ReceiptLogGraderIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class GraderInReceiptHPHexport implements WithHeadings,FromCollection
{
    
    protected $id;
    
    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $hph = DB::table('receiptlog')
                ->leftJoin('receiptlogdetail_graderin as i', 'receiptlog.id', '=', 'i.receiptlog_id')
                ->select('receiptlog.code', 'i.nextmap','i.nokayu','i.kwt','i.dia1',
                'i.dia2','i.dia3','i.dia4','i.dia_avg','i.class','i.heightfull','i.widthfull','i.lenfull','i.lenmin','i.lennett','i.heighttrim','i.widthtrim','i.lengr','i.lenkm','i.lentrim','i.heightmin','i.heightnett','i.widthmin','i.widthnett', 'i.p_len','i.p_m3', 'i.dia_gr','i.nobarcode','i.nopohon','i.nopetak','i.po_price','i.gross_price','i.discount','i.discount_value','i.surcharges','i.surcharges_value','i.adj','i.totprice','i.dia1_teras','i.dia2_teras','i.dia3_teras','i.dia4_teras','i.diaavg_teras','i.p_m3_teras','i.po_price_teras','i.gross_price_teras','i.discount_teras','i.discountvalue_teras','i.surcharges_teras','i.surcharges_value_teras','i.adj_teras','i.totprice_teras','i.owner','i.kph_type','i.hjd','i.range_size','i.range_length')
                ->where('receiptlog.id_receipthph','=',$this->id)
                ->get();
        return $hph;
    }

    public function headings(): array{
        return['Receipt Log ID','Next Map','No Kayu','Kwt/Quality', 'Dia 1','Dia 2', 'Dia 3', 'Dia 4', 'Dia Avg', 'Class/Sortimen', 'Height Full', 'Width Full', 'Len Full', 'Len Min', 'Len Nett', 'Height Trim', 'Width Trim', 'Len Gr', 'Len Km' ,'Len Trim', 'Height Min','Height Nett','Width Min','Width Nett','P Len','P M3','Dia Gr','No Barcode','No Pohon','No Petak','PO Price','Gross Price','Discount%','Discount Value','Surcharges%','Surcharges Value','Adj(+/-)','TotPrice','Dia 1 (teras)','Dia 2 (teras)','Dia 3 (teras)','Dia 4 (teras)','Dia Avg (teras)', 'P M3 (teras)', 'PO Price (teras)', 'Gross Price (teras)', 'Discount% (teras)', 'Discount Value (teras)', 'Surcharges% Value','Surcharges Value (teras)', 'Adj(+/-) (teras)', 'TotPrice (teras)','Owner', 'KPH type', 'HJD Price', 'Range Dia','Range Length'];
    }
}
