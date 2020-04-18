<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class owner extends Model
{
    protected $table = 'owner';
    protected $fillable = ['id','owner_code','owner_name','owner_legend','create_at','update_at','is_delete', ];
}