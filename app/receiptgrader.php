<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receiptgrader extends Model
{
    protected $table = 'receiptlogdetail_grader';
    protected $fillable = ['id','noreceiptlog','name','location','statusgrader'];

    public function receiptlog()
    {
        return $this->hasMany('App\ReceiptLog', 'id', 'noreceiptlog');
    }
}
