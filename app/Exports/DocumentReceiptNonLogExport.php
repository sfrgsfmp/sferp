<?php

namespace App\Exports;

use App\ReceiptLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentReceiptNonLogExport implements WithHeadings,FromCollection
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
        return ReceiptLog::select(['code'])->where('id',$this->id)->get();
    }

    public function headings(): array{
        return['Receipt Non Log','Next Map', 'Length', 'Height', 'Width', 'M3', 'Qty','Quality', 'Spec2'];
    }
}
