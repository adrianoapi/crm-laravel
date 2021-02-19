<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SegundaFase extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function setMultaAttribute($value)
    {
        return $this->attributes['multa'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getMultaAttribute($value)
    {
        return $this->attributes['multa'] = number_format($value, 2, ",", ".");
    }

    public function setTotalAttribute($value)
    {
        return $this->attributes['total'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getTotalttribute($value)
    {
        return $this->attributes['total'] = number_format($value, 2, ",", ".");
    }

    public function setMParcelaValorAttribute($value)
    {
        return $this->attributes['m_parcela_valor'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getMParcelaValorAttribute($value)
    {
        return $this->attributes['m_parcela_valor'] = number_format($value, 2, ",", ".");
    }

    public function setMParcelaTotalAttribute($value)
    {
        return $this->attributes['m_parcela_total'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getMParcelaTotalAttribute($value)
    {
        return $this->attributes['m_parcela_total'] = number_format($value, 2, ",", ".");
    }

    public function setSParcelaValorAttribute($value)
    {
        return $this->attributes['s_parcela_valor'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getSParcelaValorAttribute($value)
    {
        return $this->attributes['s_parcela_valor'] = number_format($value, 2, ",", ".");
    }

    public function setSParcelaTotalAttribute($value)
    {
        return $this->attributes['s_parcela_total'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getSParcelaTotalAttribute($value)
    {
        return $this->attributes['s_parcela_total'] = number_format($value, 2, ",", ".");
    }

    public function setDtInadimplenciaAttribute($value)
    {
        $date = str_replace('/', '-', $value);
        return $this->attributes['dt_inadimplencia'] = date("Y-m-d", strtotime($date));
    }

    public function getDtInadimplenciaAttribute($value)
    {
        return $this->attributes['dt_inadimplencia'] = date("d/m/Y", strtotime($value));
    }
}
