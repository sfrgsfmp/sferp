<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    protected $table = 'section';
    protected $fillable = ['id','code','name','create_at','update_at','is_delete', ];
}