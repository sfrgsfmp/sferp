<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class measurement extends Model
{
    protected $table = 'measurement';
    protected $fillable = ['id','measurement_code','measurement_name','create_at','update_at','is_delete', ];
}