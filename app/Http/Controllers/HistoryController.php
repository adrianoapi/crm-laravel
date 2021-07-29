<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private $title  = 'Contato';


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = $this->title. " Dashboard";

        return view('historical.index', [
            'title' => $title,
            'historical' => $this->getAll(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        switch ($request->modulo) {
            case 'cheque':
                $modulo = \App\BankChequeHistory::where('id', $request->id)
                ->where('schedule','open')
                ->firstOrFail();
                break;
            case 'contrato':
                $modulo = \App\DefaultingHistory::where('id', $request->id)
                ->where('schedule','open')
                ->firstOrFail();
                break;
            default:
                $modulo = \App\GraphicHistory::where('id', $request->id)
                ->where('schedule','open')
                ->firstOrFail();
                break;
        }

        if(!empty($modulo))
        {
            $modulo->user_id  = Auth::id();
            $modulo->schedule = 'close';
            if($modulo->save())
            {
                return redirect()->route('history.index');
            }
        }else{
            die('Registro não encontrado!');
        }

    }

    public function getAll()
    {
        return DB::select("SELECT de.fase, st.cod_unidade, st.cod_curso, st.ctr, st.name, st.cpf_cnpj,
        if(bc.id > 0,bct.id, if(de.id > 0, det.id, grt.id)) AS id,
        if(bc.id > 0,'cheque', if(de.id > 0, 'contrato', 'grafica')) AS modulo,
        if(bc.id > 0, bct.observacao, if(de.id > 0, det.observacao, grt.observacao)) AS observacao,
        DATE_FORMAT(if(bc.id > 0, bct.created_at, if(de.id > 0, det.created_at, grt.created_at)), '%d/%m/%Y') AS created_at,
        if(bc.id > 0, bct.schedule, if(de.id > 0, det.schedule, grt.schedule)) as schedule
        FROM students AS st
        LEFT JOIN bank_cheques AS bc
               ON (st.id = bc.student_id)
        LEFT JOIN bank_cheque_histories AS bct
               ON (bc.id = bct.bank_cheque_id)
        LEFT JOIN defaultings  AS de
               ON (st.id = de.student_id)
        LEFT JOIN defaulting_histories AS det
               ON (de.id = det.defaulting_id)
        LEFT JOIN graphics     AS gr
               ON (st.id = gr.student_id)
        LEFT JOIN graphic_histories AS grt
               ON (gr.id = grt.graphic_id)
        where
        if(bc.id > 0, bct.schedule, if(de.id > 0, det.schedule, grt.schedule)) = 'open'
        order by st.name ASC
        limit 30000"
        );
    }

}
