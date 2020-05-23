<?php

namespace App\Exports;

use App\ReceiptLogInvoicing;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class InvoicingReceiptHPHreport implements WithEvents,WithHeadings,FromCollection
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    

    public function collection()
    {
        $inv = DB::table('receiptlogdetail_invoicing')
            ->leftJoin('receiptlog','receiptlogdetail_invoicing.receiptlog_id','=','receiptlog.id')
            ->leftJoin('quality','receiptlogdetail_invoicing.quality','=','quality.id')
            ->leftJoin('sortimen','receiptlogdetail_invoicing.sortimen','=','sortimen.id')
            ->leftJoin('kphtype','receiptlogdetail_invoicing.kphtype','=','kphtype.id')
            ->select('receiptlog.code as code_receiptlog',
            'sortimen.code as sortimencode',
            'quality.quality_code as qualitycode',
            'receiptlogdetail_invoicing.range_size',
            'receiptlogdetail_invoicing.range_length',
            'kphtype.code',
            'receiptlogdetail_invoicing.price',
            'receiptlogdetail_invoicing.in_qty',
            'receiptlogdetail_invoicing.in_m3',
            'receiptlogdetail_invoicing.in_totprice',
            'receiptlogdetail_invoicing.doc_qty',
            'receiptlogdetail_invoicing.doc_m3',
            'receiptlogdetail_invoicing.doc_totprice',
            'receiptlogdetail_invoicing.ven_qty',
            'receiptlogdetail_invoicing.ven_m3',
            'receiptlogdetail_invoicing.ven_totprice'
            )
            ->where('receiptlog.id_receipthph',$this->id)
            ->get();
        // return ReceiptLogInvoicing::where('receiptlog_id',$this->id)->get();
        return $inv;
    }

    public function registerEvents(): array{
        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        return [
            
            AfterSheet::class => function (AfterSheet $event) use ($styleArray){
                $event->sheet->getStyle('A1:P1')->applyFromArray($styleArray);
            }
        ];
    }

    public function headings(): array{
        return['Receipt Log','Sortimen','Quality', 'Range Dia', 'Range Length', 'KPH Type','Price', 'Graderin Qty', 'Graderin M3', 'Graderin Totprice', 'Doc Qty', 'Doc M3', 'Doc Totprice', 'Ven Qty', 'Ven M3', 'Ven Totprice'];
    }

}
