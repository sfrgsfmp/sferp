<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortimenDet extends Model
{
    protected $table = 'sortimendet';
    protected $fillable = ['id', 'sortimen_code', 'dia_det', 'range_size'];
}
