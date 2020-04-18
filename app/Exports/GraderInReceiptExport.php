<?php

namespace App\Exports;

use App\ReceiptLogGraderIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GraderInReceiptExport implements WithHeadings,FromCollection
{
    
    protected $id;
    
    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // return ReceiptLogGraderOut::all();
        return ReceiptLogGraderIn::where('receiptlog_id',$this->id)->get();
    }

    public function headings(): array{
        return['Receipt Log ID','Next Map','No Kayu','Kwt/Quality', 'Dia 1','Dia 2', 'Dia 3', 'Dia 4', 'Dia Avg', 'Class/Sortimen', 'Height Full', 'Width Full', 'Len Full', 'Len Min', 'Len Nett', 'Height Trim', 'Width Trim', 'Len Gr', 'Len Km' ,'Len Trim', 'Height Min','Height Nett','Width Min','Width Nett','P Len','P M3','Dia Gr','No Barcode','No Pohon','No Petak','PO Price','Gross Price','Discount%','Discount Value','Surcharges%','Surcharges Value','Adj(+/-)','TotPrice','Dia 1 (teras)','Dia 2 (teras)','Dia 3 (teras)','Dia 4 (teras)','Dia Avg (teras)', 'P M3 (teras)', 'PO Price (teras)', 'Gross Price (teras)', 'Discount% (teras)', 'Discount Value (teras)', 'Surcharges% Value','Surcharges Value (teras)', 'Adj(+/-) (teras)', 'TotPrice (teras)','Owner', 'KPH type', 'HJD Price', 'Range Dia','Range Length'];
    }
}
