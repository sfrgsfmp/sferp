<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndDistrict extends Model
{
    protected $table = 'indonesia_districts';

    protected $fillable = ['id', 'city_id', 'name', 'meta'];


}
