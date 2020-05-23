<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterCode extends Model
{
    protected $table = 'registercode';
    protected $fillable = ['id','code','desc', 'is_delete','is_sawmill'];

}
