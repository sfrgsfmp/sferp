<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    protected $table = 'currency';
    protected $fillable = ['id','code','name','symbol','create_at','update_at','is_delete', ];
}