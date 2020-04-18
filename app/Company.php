<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = ['id', 'code', 'name', 'address', 'country', 'province_id', 'city_id', 'postal', 'phone', 'fax', 'email','website', 'logo', 'npwp', 'type', 'loadingport', 'desc', 'contact_person'];
}
