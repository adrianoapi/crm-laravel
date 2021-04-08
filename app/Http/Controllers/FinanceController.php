<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    private $title  = 'CAIXA';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = $this->title. " Dashboard";
        $expensive = DB::select("SELECT de.fase, st.cod_unidade, st.cod_curso, st.ctr, st.name, st.cpf_cnpj,
        if(bc.id > 0,'cheque', if(de.id > 0, 'contrato', 'grafica')) AS modulo,
        --if(bc.id > 0, bct.parcela, if(de.id > 0, det.parcela, grt.parcela)) AS parcela,
        --if(bc.id > 0, bct.valor, if(de.id > 0, det.valor, grt.valor)) AS valor,
        --if(bc.id > 0, bct.vencimento, if(de.id > 0, det.vencimento, grt.vencimento)) AS vencimento,
        if(bc.id > 0, bct.dt_pagamento, if(de.id > 0, det.dt_pagamento, grt.dt_pagamento)) AS dt_pagamento,
        if(bc.id > 0, bct.valor_pago, if(de.id > 0, det.valor_pago, grt.valor_pago)) AS valor_pago,
        if(bc.id > 0, bct.pagamento, if(de.id > 0, det.pagamento, grt.pagamento)) AS pagamento
        FROM crm_laravel.students AS st
        LEFT JOIN crm_laravel.bank_cheques AS bc
               ON (st.id = bc.student_id)
        LEFT JOIN crm_laravel.bank_cheque_tradings AS bct
               ON (bc.id = bct.bank_cheque_id)
        LEFT JOIN crm_laravel.defaultings  AS de
               ON (st.id = de.student_id)
        LEFT JOIN crm_laravel.defaulting_tradings AS det
               ON (de.id = det.defaulting_id)
        LEFT JOIN crm_laravel.graphics     AS gr
               ON (st.id = gr.student_id)
        LEFT JOIN crm_laravel.graphic_tradings AS grt
               ON (gr.id = grt.graphic_id)
        where
        (bct.vencimento  >= '2021-03-01' OR
        det.vencimento >= '2021-03-01' OR
        grt.vencimento >= '2021-03-01') AND
        (bct.vencimento  >= '2021-03-31' OR
        det.vencimento >= '2021-03-31' OR
        grt.vencimento <= '2021-03-31')
        order by st.name ASC
        limit 1000;");

        return view('finances.index', ['caixa' => $expensive, 'title' => $title]);
    }

}
