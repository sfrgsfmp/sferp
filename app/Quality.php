<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quality extends Model
{
    protected $table = 'quality';
    protected $fillable = ['id','quality_code','quality_name','quality_legend','is_delete', 'quality_type' ];
}