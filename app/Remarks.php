<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    protected $table = 'remarks';
    protected $fillable = ['id','name','is_delete','tipe'];
    
}
