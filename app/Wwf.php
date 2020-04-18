<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wwf extends Model
{
    protected $table = 'wwf';
    protected $fillable = ['id','code','name','desc','is_delete'];
}
