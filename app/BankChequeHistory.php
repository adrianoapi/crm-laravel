<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankChequeHistory extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bankCheques()
    {
        return $this->belongsTo(BankCheque::class, 'bank_cheque_id', 'id');
    }
}
