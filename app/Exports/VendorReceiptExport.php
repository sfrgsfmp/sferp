<?php

namespace App\Exports;

use App\ReceiptLogVendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorReceiptExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // return VendorReceipt::select(['receiptlog_id', 'nextmap'])->get();
        return ReceiptLogVendor::select(['receiptlog_id', 'nextmap', 'nokayu', 'dia', 'length', 'height', 'width','m3', 'nobarcode', 'nopohon', 'nopetak', 'quality','hjd','price_po','range_size','range_length'])->where('receiptlog_id',$this->id)->get();
    }

    public function headings(): array{
        return['Receipt Log ID','Next Map','No Kayu', 'Dia', 'Length', 'Height', 'Width', 'M3', 'No Barcode', 'No Pohon', 'No Petak', 'Quality', 'HJD Price', 'PO Price', 'Range Dia', 'Range Length'];
    }
}
