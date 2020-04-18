<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradingResult extends Model
{
    protected $table = 'grading_result';

    protected $fillable = ['id', 'sendgrader_id', 'date', 'tipebiaya', 'keterangan', 'biaya','nokendaraan','btg', 'm3', 'harga/m3', 'created_by', 'status', 'approval_statusby'];


    public function sendgrader()
    {
        return $this->belongsTo('App\SendGrader', 'sendgrader_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'approval_statusby', 'id'); 
    }

}
