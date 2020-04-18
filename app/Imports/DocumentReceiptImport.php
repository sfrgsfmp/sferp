<?php

namespace App\Imports;

use App\ReceiptLogDocument;
use App\SortimenDet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DocumentReceiptImport implements ToModel, WithCalculatedFormulas, WithStartRow
{
    // use Importable;
    public $called = false;

    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        $this->called = true;

        return new ReceiptLogDocument([
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
            'nokapling' => $row[12],
            'nobp' => $row[13],
            'umurkapling'=> $row[14],
            'kayuno2' => $row[15],
            'partaibp' => $row[16],
            'asaltahun' => $row[17],
            'price_po' => $row[18],
            'hjd' => Assert::assertSame(2, $row[19]),
            'hjdxm3' => Assert::assertSame(2, $row[20]),
            'discount' => $row[21],
            'value_discount' => Assert::assertSame(2, $row[22]),
            'kphtype' => $row[23],
            'range_size' => Assert::assertSame(2, $row[24]),
            'range_length' => Assert::assertSame(2, $row[25])
        ]);
    }
}
