<?php

namespace App\Exports;

use App\ReceiptLogVendor;
use App\ReceiptHPH;
use App\ReceiptLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;

class VendorReceiptHPHexport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct( $id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        $hph = DB::table('receiptlog')
                ->leftJoin('receiptlogdetail_vendor', 'receiptlog.id', '=', 'receiptlogdetail_vendor.receiptlog_id')
                ->select('receiptlog.code', 'receiptlogdetail_vendor.nextmap','receiptlogdetail_vendor.nokayu','receiptlogdetail_vendor.dia','receiptlogdetail_vendor.length','receiptlogdetail_vendor.height','receiptlogdetail_vendor.width','receiptlogdetail_vendor.m3','receiptlogdetail_vendor.nobarcode','receiptlogdetail_vendor.nopohon','receiptlogdetail_vendor.nopetak','receiptlogdetail_vendor.quality','receiptlogdetail_vendor.hjd', 'receiptlogdetail_vendor.price_po','receiptlogdetail_vendor.range_size', 'receiptlogdetail_vendor.range_length','receiptlogdetail_vendor.kphtype')
                ->where('receiptlog.id_receipthph','=',$this->id)
                ->get();
        return $hph;
    }

    public function headings(): array{
        return['Receipt Log ID','Next Map','No Kayu', 'Dia', 'Length', 'Height', 'Width', 'M3', 'No Barcode', 'No Pohon', 'No Petak', 'Quality', 'HJD Price', 'PO Price', 'Range Dia', 'Range Length'];
    }
}
