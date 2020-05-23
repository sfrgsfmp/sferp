<?php

namespace App\Exports;

use App\ReceiptLogDocument;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\DB;

class DocumentReceiptHPHexport implements WithHeadings,FromCollection
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $doc = DB::table('receiptlog')
            ->leftJoin('receiptlogdetail_document', 'receiptlog.id', '=', 'receiptlogdetail_document.receiptlog_id')
            ->select('receiptlog.code', 'receiptlogdetail_document.nextmap','receiptlogdetail_document.nokayu','receiptlogdetail_document.dia','receiptlogdetail_document.length','receiptlogdetail_document.height','receiptlogdetail_document.width','receiptlogdetail_document.m3','receiptlogdetail_document.nobarcode','receiptlogdetail_document.nopohon','receiptlogdetail_document.nopetak','receiptlogdetail_document.quality', 'receiptlogdetail_document.nokapling','receiptlogdetail_document.nobp','receiptlogdetail_document.umurkapling','receiptlogdetail_document.kayuno2','receiptlogdetail_document.partaibp','receiptlogdetail_document.asaltahun', 'receiptlogdetail_document.price_po','receiptlogdetail_document.hjd','receiptlogdetail_document.hjdxm3','receiptlogdetail_document.discount','receiptlogdetail_document.value_discount','receiptlogdetail_document.kphtype','receiptlogdetail_document.range_size', 'receiptlogdetail_document.range_length')
            ->where('receiptlog.id_receipthph','=',$this->id)
            ->get();
        return $doc;
    }

    public function headings(): array{
        return['Receipt Log ID','xNext Map','No Kayu', 'Dia', 'Length', 'Height', 'Width', 'M3', 'No Barcode', 'No Pohon', 'No Petak', 'Quality', 'No Kapling', 'No BP', 'Umur Kapling', 'Kayu No2', 'Partai BP', 'Asal Tahun','PO Price','HJD Price','HJD x M3','Discount','Value Discount','KPH Type', 'Range Dia', 'Range Length'];
    }

}
