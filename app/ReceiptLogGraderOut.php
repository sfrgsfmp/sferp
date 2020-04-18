<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptLogGraderOut extends Model
{
    protected $table = 'receiptlogdetail_graderout';
    protected $fillable = ['receiptlog_id','nextmap','nokayu','kwt','dia1','dia2', 'dia3', 'dia4', 'dia_avg', 'class', 'heightfull', 'widthfull', 'lenfull', 'lenmin', 'lennett', 'heighttrim', 'widthtrim', 'lengr', 'lenkm' ,'lentrim', 'heightmin','heightnett','widthmin','widthnett','p_len','p_m3','dia_gr','nobarcode','nopohon','nopetak','po_price','gross_price','discount','discount_value','surcharges','surcharges_value','adj','totprice','dia1_teras','dia2_teras','dia3_teras','dia4_teras','diaavg_teras', 'p_m3_teras', 'po_price_teras', 'gross_price_teras', 'discount_teras', 'discountvalue_teras','surcharges_teras','surcharges_value_teras', 'adj_teras','totprice_teras','owner','kph_type', 'hjd','range_size', 'range_length'];

    protected $hidden = ['created_at', 'updated_at'];
    
    public function receiptlog()
    {
        return $this->hasMany('App\ReceiptLog', 'id', 'receiptlog_id');
    }

    public function quality()
    {
        return $this->hasMany('App\quality', 'id', 'kwt');
    }

    public function kphtype()
    {
        return $this->hasMany('App\kphtype', 'id', 'kph_type');
    }

    public function class()
    {
        return $this->hasMany('App\Sortimen', 'id', 'class');
    }
}
