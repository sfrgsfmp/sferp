<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PO_detail extends Model
{
    protected $table = 'po_transactiondet';
    protected $fillable = ['id','code_po','species_id','spec1_id','spec2_id','sortimen','quality_id', 'price', 'charge', 'discount', 'totalprice_det','komposisi_desc', 'komposisipjg_desc', 'cuttdia_min', 'cuttdia_max', 'invdia_min', 'invdia_max', 'cuttheight_min', 'cuttheight_max', 'invheight_min', 'invheight_max', 'cuttwidth_min', 'cuttwidth_max', 'invwidth_min', 'invwidth_max', 'cuttlength_min', 'cuttlength_max', 'invlength_min', 'invlength_max', 'm3', 'mutukayu_desc', 'statuskayu_desc', 'is_delete'];

    public function scopeinvlength()
    {
        $get = DB::table('po_transactiondet')
            ->groupBy('invlength_min')
            ->get();

        return $get;
    }
    
   public function po()
   {
        return $this->belongsTo('App\PO', 'code_po', 'code');
   }
   
   public function sortimen()
   {
       return $this->hasOne('App\Sortimen','id', 'sortimen');
   }

   public function species()
   {
       return $this->hasOne('App\Species', 'id', 'species_id');
   }

   public function quality()
   {
       return $this->hasOne('App\Quality', 'id', 'quality_id');
   }

   public function spec1()
   {
       return $this->hasOne('App\Specification', 'id', 'spec1_id');
   }

   public function spec2()
   {
       return $this->hasOne('App\Specification', 'id', 'spec2_id');
   }
//    public function company()
//    {
//        return $this->belongsTo('App\Company', )
//    }
}
