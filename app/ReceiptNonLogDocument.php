<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptNonLogDocument extends Model
{
    protected $table = 'receiptnonlog_document';
    protected $fillable = ['receiptlog_id','nextmap','length', 'height', 'width', 'm3', 'qty', 'quality', 'spec2'];

    public function receiptlog()
    {
        return $this->hasMany('App\ReceiptLog', 'id', 'receiptlog_id');
    }
}
