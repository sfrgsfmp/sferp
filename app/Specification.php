<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $table = 'specification';
    protected $fillable = ['id','name','legend','autocode','vendorname', 'type_specification'];
}
