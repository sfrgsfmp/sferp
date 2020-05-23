<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentItem extends Model
{
    protected $table = 'component_item';
    protected $fillable = ['id','name','is_delete'];
}
