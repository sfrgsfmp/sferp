<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptNonLogGraderIn extends Model
{
    protected $table = 'receiptnonlog_graderin';
    protected $fillable = ['id','receiptlog_id','st_id','po_price','is_delete'];
}
