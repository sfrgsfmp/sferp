<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptLogInvoicing extends Model
{
    protected $table = 'receiptlogdetail_invoicing';
    protected $fillable = ['receiptlog_id','range_size','range_length','quality','sortimen','kphtype', 'price', 'in_qty', 'in_m3', 'in_totprice', 'out_qty', 'out_m3', 'out_totprice', 'doc_qty', 'doc_m3', 'doc_totprice', 'ven_qty', 'ven_m3', 'ven_totprice'];

    protected $hidden = ['created_at', 'updated_at'];
    
    public function receiptlog()
    {
        return $this->hasMany('App\ReceiptLog', 'id', 'receiptlog_id');
    }

    public function quality()
    {
        return $this->hasMany('App\quality', 'id', 'quality');
    }

    public function sortimen()
    {
        return $this->hasMany('App\Sortimen', 'id', 'sortimen');
    }

    public function kphtype()
    {
        return $this->hasMany('App\kphtype', 'id', 'kphtype');
    }
}
