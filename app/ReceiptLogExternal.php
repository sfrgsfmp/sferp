<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptLogExternal extends Model
{
    protected $table = 'receiptlogdetail_external';
    protected $fillable = ['receiptlog_id','nextmap','noproduct','codeproduct'];

    protected $hidden = ['created_at', 'updated_at'];

    public function items()
    {
        return $this->hasOne('App\Itemproduct', 'noproduct_id', 'noproduct');
    }
    
}
