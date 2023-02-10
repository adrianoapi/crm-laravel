<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends UtilController
{

    private $title  = 'RECEBIMENTO';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title. " listar";

        $payment = Payment::where('deleted_at', NULL)->orderBy('dt_pagamento', 'desc')
        ->paginate(100);

        return view('payment.index', [
            'payments' => $payment,
            'title' =>$title
        ]);
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
                if($request->payment_tipo == 'grafica_1' || $request->payment_tipo == 'grafica_2')
                {
                    $model = new \App\Graphic();
                    $graphic = $model::where('id', $request->payment_referencia_id)->get();
                    
                    $atributos['tipo' ] = $graphic[0]->tipo;
                    $atributos['nome' ] = $graphic[0]->student_name;
                    $atributos['valor'] = $graphic[0]->total;

                    $atributos['cpf_cnpj'] = $graphic[0]->student->cpf_cnpj;
                    $atributos['referencia_id'] = $graphic[0]->id;
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
