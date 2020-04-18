<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptLogDocument extends Model
{
    protected $table = 'receiptlogdetail_document';
    protected $fillable = ['receiptlog_id','nextmap','nokayu', 'dia','length', 'height', 'width', 'm3', 'nobarcode', 'nopohon', 'nopetak', 'quality', 'nokapling', 'nobp', 'umurkapling', 'kayuno2', 'partaibp', 'asaltahun', 'price_po', 'hjd','hjdxm3','discount','value_discount','kphtype', 'range_size', 'range_length'];

    public function receiptlog()
    {
        return $this->hasMany('App\ReceiptLog', 'id', 'receiptlog_id');
    }

    public function quality()
    {
        return $this->hasMany('App\quality', 'id', 'quality');
    }

    public function kphtype()
    {
        return $this->hasMany('App\kphtype', 'id', 'kphtype');
    }

}
