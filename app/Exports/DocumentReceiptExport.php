<?php

namespace App\Exports;

use App\ReceiptLogDocument;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithEvents;

class DocumentReceiptExport implements WithHeadings,FromCollection
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return ReceiptLogDocument::select(['receiptlog_id', 'nextmap', 'nokayu', 'dia', 'length', 'height', 'width','m3', 'nobarcode', 'nopohon', 'nopetak', 'quality', 'nokapling', 'nobp', 'umurkapling', 'kayuno2', 'partaibp', 'asaltahun','price_po','hjd', 'hjdxm3', 'discount','value_discount','kphtype','range_size','range_length'])->where('receiptlog_id',$this->id)->get();
    }

    public function headings(): array{
        return['Receipt Log ID','xNext Map','No Kayu', 'Dia', 'Length', 'Height', 'Width', 'M3', 'No Barcode', 'No Pohon', 'No Petak', 'Quality', 'No Kapling', 'No BP', 'Umur Kapling', 'Kayu No2', 'Partai BP', 'Asal Tahun','PO Price','HJD Price','HJD x M3','Discount','Value Discount','KPH Type', 'Range Dia', 'Range Length'];
    }

}
