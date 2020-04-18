<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sortimen extends Model
{
    protected $table = 'sortimen';
    protected $fillable = ['id', 'code'];
}
