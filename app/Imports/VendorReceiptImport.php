<?php

namespace App\Imports;

use App\ReceiptLogVendor;
use App\ReceiptLog;
use App\Quality;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VendorReceiptImport implements ToModel, WithCalculatedFormulas,WithStartRow
{
    public $called = false;
    
    public $quality;
   

    // public function mapping(): array
    // {
        
    //     $quality = Quality::select('convert_quality('.$row[11].')')
    //                     ->where('quality_code',$row[11])
    //                     ->get();

    //     foreach($quality as $relation)
    //     { 
           
    //         return [
    //             'quality' => $relation[0]
    //         ];
    //     }
    // }
    public function startRow(): int
    {
        return 2;
    }
   
    public function model(array $row)
    {
        $this->called = true;
        
        $vendor = new ReceiptLogVendor([
            'receiptlog_id' => $row[0],
            'nextmap' => $row[1],
            'nokayu' => $row[2],
            'dia' => $row[3],
            'length' => $row[4],
            'height' => $row[5],
            'width' => $row[6],
            'm3' => $row[7],
            'nobarcode' => $row[8],
            'nopohon' => $row[9],
            'nopetak' => $row[10],
            'quality' => $row[11],
            'hjd' => Assert::assertSame(2, $row[12]),
            'price_po' => $row[13],
            'range_size' => Assert::assertSame(2, $row[14]),
            'range_length' => Assert::assertSame(2, $row[15])
        ]);

        return $vendor;

    }

    
}
