<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function graphicTipos()
    {
        return [
            'grafica' => 'Gráfica',
            'holding' => 'Gráfica Holding'
        ];
    }
}
