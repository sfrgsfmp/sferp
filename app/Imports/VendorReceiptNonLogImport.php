<?php

namespace App\Imports;

use App\ReceiptNonLogVendor;
use App\ReceiptLog;
use App\Quality;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VendorReceiptNonLogImport implements ToModel, WithCalculatedFormulas
{
    public $called = false;
    
    public $quality;
   
    // public function startRow(): int
    // {
    //     return 2;
    // }
   
    public function model(array $row)
    {
        $this->called = true;
        
        $vendor = new ReceiptNonLogVendor([
            'receiptlog_id' => $row[0],
            'nextmap' => $row[1],
            'length' => $row[2],
            'height' => $row[3],
            'width' => $row[4],
            'm3' => $row[5],
            'qty' => $row[6],
            'quality' => $row[7],
            'spec2'=> $row[8]
            // 'hjd' => Assert::assertSame(2, $row[12]),
        ]);

        return $vendor;

    }

    
}
