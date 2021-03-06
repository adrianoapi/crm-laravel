<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    private $title  = 'CAIXA';

    private $dtInicial;
    private $dtFinal;

    public function __construct()
    {
        $this->middleware('auth');

        $this->dtInicial = date('Y-m-01');
        $this->dtFinal   = date('Y-m-t' );
    }

    public function index()
    {
        $title = $this->title. " Dashboard";
        $pagamento = true;

        if(array_key_exists('pagamento', $_GET))
        {
            $this->dtInicial = strlen($_GET['dt_inicio']) > 2 ? $this->dataSql($_GET['dt_inicio']) : $this->dtInicial;
            $this->dtFinal   = strlen($_GET['dt_fim'   ]) > 2 ? $this->dataSql($_GET['dt_fim'   ]) : $this->dtFinal;

            $pagamento = ($_GET['pagamento'] == 'sim') ? true : false;
        }

        $pgtEfetuado = ($pagamento) ? 'IS NOT NULL'  : 'IS NULL';
        $dataLimit   = ($pagamento) ? 'dt_pagamento' : 'vencimento';

        $expensive = DB::select("SELECT de.fase, st.cod_unidade, st.cod_curso, st.ctr, st.name, st.cpf_cnpj,
        if(bc.id > 0,bc.id, if(de.id > 0, de.id, gr.id)) AS id,
        if(bc.id > 0,'cheque', if(de.id > 0, 'contrato', 'grafica')) AS modulo,
        if(bc.id > 0, bct.parcela, if(de.id > 0, det.parcela, grt.parcela)) AS parcela,
        if(bc.id > 0, bct.valor, if(de.id > 0, det.valor, grt.valor)) AS valor,
        if(bc.id > 0, bct.vencimento, if(de.id > 0, det.vencimento, grt.vencimento)) AS vencimento,
        if(bc.id > 0, bct.dt_pagamento, if(de.id > 0, det.dt_pagamento, grt.dt_pagamento)) AS dt_pagamento,
        if(bc.id > 0, bct.valor_pago, if(de.id > 0, det.valor_pago, grt.valor_pago)) AS valor_pago,
        if(bc.id > 0, bct.pagamento, if(de.id > 0, det.pagamento, grt.pagamento)) AS pagamento
        FROM students AS st
        LEFT JOIN bank_cheques AS bc
               ON (st.id = bc.student_id)
        LEFT JOIN bank_cheque_tradings AS bct
               ON (bc.id = bct.bank_cheque_id)
        LEFT JOIN defaultings  AS de
               ON (st.id = de.student_id)
        LEFT JOIN defaulting_tradings AS det
               ON (de.id = det.defaulting_id)
        LEFT JOIN graphics     AS gr
               ON (st.id = gr.student_id)
        LEFT JOIN graphic_tradings AS grt
               ON (gr.id = grt.graphic_id)
        where
        if(bc.id > 0, bct.{$dataLimit}, if(de.id > 0, det.{$dataLimit}, grt.{$dataLimit})) >= '{$this->dtInicial}' AND
        if(bc.id > 0, bct.{$dataLimit}, if(de.id > 0, det.{$dataLimit}, grt.{$dataLimit})) <= '{$this->dtFinal}'   AND
        if(bc.id > 0, bct.dt_pagamento, if(de.id > 0, det.dt_pagamento, grt.dt_pagamento)) {$pgtEfetuado}
        order by st.name ASC
        limit 30000"
        );

        return view('finances.index', [
            'caixa'     => $expensive,
            'title'     => $title,
            'dt_inicio' => $this->dataBr($this->dtInicial),
            'dt_fim'    => $this->dataBr($this->dtFinal),
            'pagamento' => $pagamento
        ]);
    }

    public function csv()
    {
        $title = $this->title. " Dashboard";
        $pagamento = true;

        if(array_key_exists('pagamento', $_GET))
        {
            $this->dtInicial = strlen($_GET['dt_inicio']) > 2 ? $this->dataSql($_GET['dt_inicio']) : $this->dtInicial;
            $this->dtFinal   = strlen($_GET['dt_fim'   ]) > 2 ? $this->dataSql($_GET['dt_fim'   ]) : $this->dtFinal;

            $pagamento = ($_GET['pagamento'] == 'sim') ? true : false;
        }

        $pgtEfetuado = ($pagamento) ? 'IS NOT NULL'  : 'IS NULL';
        $dataLimit   = ($pagamento) ? 'dt_pagamento' : 'vencimento';

        $expensive = DB::select("SELECT de.fase, st.cod_unidade, st.cod_curso, st.ctr, st.name, st.cpf_cnpj,
        if(bc.id > 0,bc.id, if(de.id > 0, de.id, gr.id)) AS id,
        if(bc.id > 0,'cheque', if(de.id > 0, 'contrato', 'grafica')) AS modulo,
        if(bc.id > 0, bct.parcela, if(de.id > 0, det.parcela, grt.parcela)) AS parcela,
        if(bc.id > 0, bct.valor, if(de.id > 0, det.valor, grt.valor)) AS valor,
        if(bc.id > 0, bct.vencimento, if(de.id > 0, det.vencimento, grt.vencimento)) AS vencimento,
        if(bc.id > 0, bct.dt_pagamento, if(de.id > 0, det.dt_pagamento, grt.dt_pagamento)) AS dt_pagamento,
        if(bc.id > 0, bct.valor_pago, if(de.id > 0, det.valor_pago, grt.valor_pago)) AS valor_pago,
        if(bc.id > 0, bct.pagamento, if(de.id > 0, det.pagamento, grt.pagamento)) AS pagamento
        FROM students AS st
        LEFT JOIN bank_cheques AS bc
               ON (st.id = bc.student_id)
        LEFT JOIN bank_cheque_tradings AS bct
               ON (bc.id = bct.bank_cheque_id)
        LEFT JOIN defaultings  AS de
               ON (st.id = de.student_id)
        LEFT JOIN defaulting_tradings AS det
               ON (de.id = det.defaulting_id)
        LEFT JOIN graphics     AS gr
               ON (st.id = gr.student_id)
        LEFT JOIN graphic_tradings AS grt
               ON (gr.id = grt.graphic_id)
        where
        if(bc.id > 0, bct.{$dataLimit}, if(de.id > 0, det.{$dataLimit}, grt.{$dataLimit})) >= '{$this->dtInicial}' AND
        if(bc.id > 0, bct.{$dataLimit}, if(de.id > 0, det.{$dataLimit}, grt.{$dataLimit})) <= '{$this->dtFinal}'   AND
        if(bc.id > 0, bct.dt_pagamento, if(de.id > 0, det.dt_pagamento, grt.dt_pagamento)) {$pgtEfetuado}
        order by st.name ASC
        limit 30000"
        );

        $fileName = 'caixa_'.time().'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $pagamentoLabel = ($pagamento)  ? 'Pago' : 'Receber';

        $columns = array(
        'Modulo',
        'Unidade',
        'Curso',
        'CTR',
        'Nome',
        'CPF/CNPJ',
        'Parcela',
        'Dt Pagamento',
        $pagamentoLabel,
        'Pagamento');



        $callback = function() use($expensive, $columns, $pagamento) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($expensive as $value)
            {
                if($value->modulo == 'cheque'){
                   $modulo = 'Cheque';
                }elseif($value->modulo == 'contrato'){
                    $modulo = ucfirst($value->fase);
                }else{
                    $modulo = 'Grafica';
                }

                $dt    = ($pagamento) ? $value->dt_pagamento : $value->vencimento;
                $valor = ($pagamento) ? $value->valor_pago : $value->valor;

                fputcsv($file, array(
                    $modulo,
                    $value->cod_unidade,
                    $value->cod_curso,
                    $value->ctr,
                    utf8_decode($value->name),
                    $value->cpf_cnpj,
                    $value->parcela,
                    $dt,
                    $valor,
                    $value->pagamento
                ));
            }

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function dataSql($value)
    {
        $date = str_replace('/', '-', $value);
        return date("Y-m-d", strtotime($date));
    }

    public function dataBr($value)
    {
        return date("d/m/Y", strtotime($value));
    }

}
