<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kphtype extends Model
{
    protected $table = 'kphtype';
    protected $fillable = ['id','code','name','create_at','update_at','is_delete' ];
}