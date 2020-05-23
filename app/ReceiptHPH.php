<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptHPH extends Model
{
    protected $table = 'receipthph';
    protected $fillable = ['id','code_hph','code_receiptlog', 'id_receiptlog', 'pimid','is_delete'];

}
