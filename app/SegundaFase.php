<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SegundaFase extends Model
{
    public function setSParcelaValorAttribute($value)
    {
        return $this->attributes['s_parcela_valor'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getSParcelaValorAttribute($value)
    {
        return $this->attributes['s_parcela_valor'] = number_format($value, 2, ",", ".");
    }
}
