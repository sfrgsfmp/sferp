<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptNonLogExternal extends Model
{
    protected $table = 'receiptnonlog_external';
    protected $fillable = ['receiptlog_id','noproduct','codeproduct'];

    protected $hidden = ['created_at', 'updated_at'];

    
}
