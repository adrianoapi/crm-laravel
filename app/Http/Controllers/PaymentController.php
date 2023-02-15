<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends UtilController
{

    private $title  = 'RECEBIMENTO';
    private $dtInicial;
    private $dtFinal;

    public function __construct()
    {
        $this->middleware('auth');

        $this->dtInicial = date('Y-m-01');
        $this->dtFinal   = date('Y-m-t' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids  = [];
        $codigo = '';
        $tipo = '';
        $nome = '';
        $cpf  = '';

        if(array_key_exists('filtro', $_GET))
        {

            if(array_key_exists('dt_inicio', $_GET) && array_key_exists('dt_fim', $_GET))
            {
                $this->dtInicial = strlen($_GET['dt_inicio']) > 2 ? $this->dataSql($_GET['dt_inicio']) : $this->dtInicial;
                $this->dtFinal   = strlen($_GET['dt_fim'   ]) > 2 ? $this->dataSql($_GET['dt_fim'   ]) : $this->dtFinal;
            }
        
            if(strlen($_GET['nome']))
            {
                $nome = $_GET['nome'];
                
                $payment = Payment::where('nome', 'like', '%' . $nome . '%')
                ->where('deleted_at', NULL)
                ->get();

                $ids = [];
                foreach($payment as $value):
                    array_push($ids, $value->id);
                endforeach;

            }else{

                $students  = Payment::where('deleted_at', NULL)->get();
                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->id);
                endforeach;
            }

            if(strlen($_GET['codigo']))
            {
                $codigo = $_GET['codigo'];
                $payment = Payment::whereIn('id', $ids)
                ->where('id', $codigo)
                ->where('deleted_at', NULL)
                ->get();

                $ids = [];
                foreach($payment as $value):
                    array_push($ids, $value->id);
                endforeach;
            }

            if(strlen($_GET['tipo']))
            {
                $tipo = $_GET['tipo'];
                $payment = Payment::whereIn('id', $ids)
                ->where('tipo', $tipo)
                ->where('deleted_at', NULL)
                ->get();

                $ids = [];
                foreach($payment as $value):
                    array_push($ids, $value->id);
                endforeach;
            }

            if(strlen($_GET['cpf']))
            {
                $cpf     = $_GET['cpf'];
                $payment = Payment::whereIn('id', $ids)
                ->where('cpf_cnpj', 'like', '%' . $cpf . '%')
                ->where('deleted_at', NULL)
                ->get();

                $ids = [];
                foreach($payment as $value):
                    array_push($ids, $value->id);
                endforeach;
            }

            # Se for Geretente Mostra tudo
            if(Auth::user()->level > 1){
                $payment = Payment::whereIn('id', $ids)
                ->where('deleted_at', NULL)
                ->where('dt_pagamento', '>=', $this->dtInicial)
                ->where('dt_pagamento', '<=', $this->dtFinal)
                ->orderBy('dt_pagamento', 'desc')
                ->paginate(100);
            }else{

                # Senão for gerente, mostra apenas os seus
                $payment = Payment::whereIn('id', $ids)
                ->where('deleted_at', NULL)
                ->where('user_id', Auth::user()->id)
                ->where('dt_pagamento', '>=', $this->dtInicial)
                ->where('dt_pagamento', '<=', $this->dtFinal)
                ->orderBy('dt_pagamento', 'desc')
                ->paginate(100);
            }
            
            

        }else{
            
            # Se for Geretente Mostra tudo
            if(Auth::user()->level > 1)
            {
                $payment = Payment::where('deleted_at', NULL)
                ->where('dt_pagamento', '>=', $this->dtInicial)
                ->where('dt_pagamento', '<=', $this->dtFinal)
                ->where('nome', 'like', '%' . $nome . '%')
                ->orderBy('dt_pagamento', 'desc')
                ->paginate(100);
            }else{
                # Senão for gerente, mostra apenas os seus
                $payment = Payment::where('deleted_at', NULL)
                ->where('user_id', Auth::user()->id)
                ->where('dt_pagamento', '>=', $this->dtInicial)
                ->where('dt_pagamento', '<=', $this->dtFinal)
                ->where('nome', 'like', '%' . $nome . '%')
                ->orderBy('dt_pagamento', 'desc')
                ->paginate(100);
            }
            
        }

        $title = $this->title. " listar";

        return view('payment.index', [
            'payments' => $payment,
            'title' =>$title,
            'dt_inicio' => $this->dataBr($this->dtInicial),
            'dt_fim'    => $this->dataBr($this->dtFinal),
            'tiposTecebimentos' => self::tiposTecebimentos(),
            'tipo' => $tipo,
            'nome' => $nome,
            'cpf' => $cpf,
            'codigo' => $codigo
        ]);
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

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $atributos['tipo' ]  = 'outro';
        $atributos['nome' ]  = NULL;
        $atributos['valor']  = NULL;

        $atributos['cpf_cnpj'] = NULL;

        /* 
        Ele pode ter mais de uma cobrança, por isso
        deve-se guardar a referência da cobrança, caso tenha
        */
        $atributos['referencia_id']  = NULL;

        if(!empty($request))
        {
            if(array_key_exists('payment_tipo', $request->all()) && array_key_exists('payment_referencia_id', $request->all()))
            {
                # Grafica
                if($request->payment_tipo == 'grafica_1' || $request->payment_tipo == 'grafica_2')
                {
                    $model = new \App\Graphic();
                    $graphic = $model::where('id', $request->payment_referencia_id)->get();
                    
                    $atributos['tipo' ] = $graphic[0]->tipo;
                    $atributos['nome' ] = $graphic[0]->student->name;
                    $atributos['valor'] = $graphic[0]->total;

                    $atributos['cpf_cnpj'] = $graphic[0]->student->cpf_cnpj;
                    $atributos['referencia_id'] = $graphic[0]->id;
                }

                #Contrato/Default
                elseif($request->payment_tipo == 'segunda' || $request->payment_tipo == 'terceira')
                {
                    $model = new \App\Defaulting();
                    $default = $model::where('id', $request->payment_referencia_id)->get();

                    $atributos['tipo' ] = $default[0]->fase;
                    $atributos['nome' ] = $default[0]->student->name;
                    $atributos['valor'] = $default[0]->s_parcela_valor;

                    $atributos['cpf_cnpj'] = $default[0]->student->cpf_cnpj;
                    $atributos['referencia_id'] = $default[0]->id;
                }

                #Cheque/BankCehque
                elseif($request->payment_tipo == 'cheque'){
                    $model = new \App\BankCheque();
                    $bank = $model::where('id', $request->payment_referencia_id)->get();
                    
                    $atributos['tipo' ] = 'cheque';
                    $atributos['nome' ] = $bank[0]->student->name;
                    $atributos['valor'] = $bank[0]->valor;

                    $atributos['cpf_cnpj'] = $bank[0]->student->cpf_cnpj;
                    $atributos['referencia_id'] = $bank[0]->id;
                }
            }
        }

        $title = $this->title. " cadastrar";
        return view('payment.add', [
            'title' => $title,
            'tiposTecebimentos' => self::tiposTecebimentos(),
            'atributos' => $atributos
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment               = new Payment();
        $payment->user_id      = Auth::id();
        $payment->nome         = $request->nome;
        $payment->cpf_cnpj     = $request->cpf_cnpj;
        $payment->valor        = $request->valor;
        $payment->tipo         = $request->tipo;
        $payment->dt_pagamento = $request->dt_pagamento;
        $payment->descricao    = $request->descricao;
        
        $payment->beneficiado_nome     = $request->beneficiado_nome;
        $payment->beneficiado_cpf_cnpj = $request->beneficiado_cpf_cnpj;

        if(array_key_exists('referencia_id', $request->all()))
        {
            $payment->referencia_id = $request->referencia_id;
        }

        if($payment->save())
        {
            return redirect()->route('recebimento.index')
                ->with('store_success','Recebimento criado com successo!');
        }

        die('Um erro ocorreu no preenchimento do formulário!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $title = $this->title. " editar";
        return view('payment.edit', [
            'title' => $title,
            'payment' => $payment,
            'tiposTecebimentos' => self::tiposTecebimentos()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function print(Payment $payment)
    {
        $title = $this->title. " editar";
        return response()->view('payment.pdf.print', [
            'title' => $title,
            'payment' => $payment,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->user_id      = Auth::id();
        $payment->nome         = $request->nome;
        $payment->cpf_cnpj     = $request->cpf_cnpj;
        $payment->valor        = $request->valor;
        $payment->tipo         = $request->tipo;
        $payment->dt_pagamento = $request->dt_pagamento;
        $payment->descricao    = $request->descricao;
        
        $payment->beneficiado_nome     = $request->beneficiado_nome;
        $payment->beneficiado_cpf_cnpj = $request->beneficiado_cpf_cnpj;

        if(array_key_exists('referencia_id', $payment->getAttributes()))
        {
            $payment->referencia_id = $request->referencia_id;
        }

        if($payment->save())
        {
            return redirect()->route('recebimento.index')
                ->with('store_success','Recebimento alterado com successo!');
        }

        die('Um erro ocorreu no preenchimento do formulário!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->user_id = Auth::id();
        $payment->deleted_at = now();

        if($payment->save())
        {
            return redirect()->route('recebimento.index')
                ->with('store_success','Recebimento excluído com successo!');
        }
    }
}
