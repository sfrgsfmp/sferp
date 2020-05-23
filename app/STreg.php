<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class STreg extends Model
{
    protected $table = 'sawntimber_reg';
    protected $fillable = ['code','reg_code', 'tt_id','owner','warehouse','description','min','max','quality','applydate', 'status', 'location', 'lhp', 'kmk', 'mapping', 'spec1', 'kdnon','spec3', 'item', 'is_delete'];

    protected $primaryKey = 'code';
}
