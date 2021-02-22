<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultingTrading extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function defaulting()
    {
        return $this->belongsTo(Unity::class, 'defaulting_id', 'id');
    }

    public function setVencimentoAttribute($value)
    {
        $date = str_replace('/', '-', $value);
        return $this->attributes['vencimento'] = date("Y-m-d", strtotime($date));
    }

    public function getVencimentoAttribute($value)
    {
        return $this->attributes['vencimento'] = date("d/m/Y", strtotime($value));
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
