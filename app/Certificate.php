<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class certificate extends Model
{
    protected $table = 'certificate';
    protected $fillable = ['id','cert_code','cert_name','create_at','update_at','is_delete', ];
}