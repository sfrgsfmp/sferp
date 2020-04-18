<?php

namespace App\Imports;

use App\ReceiptLogGraderIn;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GraderInReceiptImport implements ToModel, WithCalculatedFormulas,WithStartRow
{
    public $called = false;

    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        $this->called = true;

        return new ReceiptLogGraderIn([
            'receiptlog_id' => $row[0],
            'nextmap' => $row[1],
            'nokayu' => $row[2],
            'kwt' => $row[3],
            'dia1' => $row[4],
            'dia2' => $row[5],
            'dia3' => $row[6],
            'dia4' => $row[7],
            'dia_avg' => Assert::assertSame(2, $row[8]),
            'class' => $row[9],
            'heightfull' => $row[10],
            'widthfull' => $row[11],
            'lenfull' => $row[12],
            'lenmin' => $row[13],
            'lennett' => $row[14],
            'heighttrim' => $row[15],
            'widthtrim' => $row[16],
            'lengr' => $row[17],
            'lenkm' => $row[18],
            'lentrim' => $row[19],
            'heightmin' => $row[20],
            'heightnett' => $row[21],
            'widthmin' => $row[22],
            'widthnett' => $row[23],
            'p_len' => $row[24],
            'p_m3' => $row[25],
            'dia_gr' => $row[26],
            'nobarcode' => $row[27],
            'nopohon' => $row[28],
            'nopetak' => $row[29],
            'po_price' => $row[30],
            'gross_price'=> Assert::assertSame(2, $row[31]),
            'discount' => $row[32],
            'discount_value' => Assert::assertSame(2, $row[33]),
            'surcharges' => $row[34],
            'surcharges_value' => Assert::assertSame(2, $row[35]),
            'adj' => Assert::assertSame(2, $row[36]),
            'totprice' => Assert::assertSame(2, $row[37]),
            'dia1_teras' => $row[38],
            'dia2_teras' => $row[39],
            'dia3_teras' => $row[40],
            'dia4_teras' => $row[41],
            'diaavg_teras' => Assert::assertSame(2, $row[42]),
            'p_m3_teras' => Assert::assertSame(2, $row[43]),
            'po_price_teras' => Assert::assertSame(2, $row[44]),
            'gross_price_teras' => Assert::assertSame(2, $row[45]),
            'discount_teras' => Assert::assertSame(2, $row[46]),
            'discountvalue_teras' => Assert::assertSame(2, $row[47]),
            'surcharges_teras' => Assert::assertSame(2, $row[48]),
            'surcharges_value_teras' => Assert::assertSame(2, $row[49]),
            'adj_teras' => Assert::assertSame(2, $row[50]),
            'totprice_teras' => Assert::assertSame(2, $row[51]),
            'owner'=> $row[52],
            'kph_type' => $row[53],
            'hjd' => Assert::assertSame(2, $row[54]),
            'range_size' => Assert::assertSame(2, $row[55]),
            'range_length' => Assert::assertSame(2, $row[56])
        ]);
    }
}
