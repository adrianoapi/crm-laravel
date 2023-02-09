<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $dates = ['deleted_at'];
    
    public function setDtPagamentoAttribute($value)
    {
        $date = str_replace('/', '-', $value);
        return $this->attributes['dt_pagamento'] = date("Y-m-d", strtotime($date));
    }

    public function getDtPagamentoAttribute($value)
    {
        return $this->attributes['dt_pagamento'] = date("d/m/Y", strtotime($value));
    }

    public function setValorAttribute($value)
    {
        return $this->attributes['valor'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getValorAttribute($value)
    {
        return $this->attributes['valor'] = number_format($value, 2, ",", ".");
    }
}
