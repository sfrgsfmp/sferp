<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barcodelist extends Model
{
    protected $table = 'barcodelist';
    protected $fillable = ['id','tt_id','barcode', 'is_delete'];
   
}
