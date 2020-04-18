<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';
    protected $fillable = ['id', 'bank_id', 'accountname', 'accountno', 'swiftcode', 'phone', 'address'];

    public function banks()
    {
        return $this->hasMany('App\Bank', 'id', 'bank_id');
    }
}
