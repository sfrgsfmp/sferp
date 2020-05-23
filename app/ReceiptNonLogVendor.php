<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptNonLogVendor extends Model
{
    protected $table = 'receiptnonlog_vendor';
    protected $fillable = ['receiptlog_id','nextmap','length', 'height', 'width', 'm3', 'qty', 'quality', 'spec2'];

    public function receiptlog()
    {
        return $this->hasMany('App\ReceiptLog', 'id', 'receiptlog_id');
    }
}
