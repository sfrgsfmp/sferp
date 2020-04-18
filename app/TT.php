<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TT extends Model
{
    
    protected $table = 'tandaterima';
    protected $fillable = ['id','code_tt','tt_no','form_no','tt_date','division','itemgroup_id','pimid','sj_no','dkp_no','doc_dt','code_document','no_document', 'doc_no','cert_claim', 'wwf_type', 'code_concession', 'name_concession', 'grade_qty','phisic_qty','doc_qty','docm3','height','width','length','province','city','district','village','grade_dt','dari','keterangan','no_spb','paydate','dischargedate','no_dokumen','jenis','tipe','btg','m3', 'is_delete'];
   
    public function pims()
    {
        return $this->hasMany('App\PIM', 'id', 'pimid');
    }

    public function itemgroups()
    {
        return $this->hasOne('App\ItemGroup', 'id', 'itemgroup_id');
    }

}
