<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndVillage extends Model
{
    protected $table = 'indonesia_villages';

    protected $fillable = ['id', 'name', 'meta'];

}
