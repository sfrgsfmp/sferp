<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptLogVendor extends Model
{
    protected $table = 'receiptlogdetail_vendor';
    protected $fillable = ['receiptlog_id','nextmap','nokayu', 'dia','length', 'height', 'width', 'm3', 'nobarcode', 'nopohon', 'nopetak', 'quality', 'hjd', 'price_po','range_size','range_length','kphtype'];

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
