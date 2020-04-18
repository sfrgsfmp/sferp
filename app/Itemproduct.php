<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemproduct extends Model
{
    protected $table = 'itemproduct_prm';
    protected $fillable = ['id','noproduct_id','codeproduct','vcode'];
   
    public function noproduct()
    {
        return $this->belongsTo('App\ReceiptLogExternal');
    }

}
