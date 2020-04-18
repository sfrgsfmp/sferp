<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    protected $table = 'vehicle';
    protected $fillable = ['id','vehicle_code','vehicle_name','create_at','update_at','is_delete', ];
}