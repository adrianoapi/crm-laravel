@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid" id="content">

    @include('layouts.navigation')

    <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3>
                                <i class="icon-reorder"></i>
                                {{$title}}
                            </h3>
                            <span class="tabs">

                                <form action="{{route('graphics.csv')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                
                                    <a href="{{route('recebimento.create')}}" class="btn btn-primary">
                                        <i class="icon-reorder"></i> Novo
                                    </a>
                                </form>
                            </span>
                            <span class="tabs">

                            </span>
                        </div>

                        <div class="box-content nopadding">
                            @if(session('store_success'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {!!session('store_success')!!}
                                </div>
                            @endif
                            <table class="table table-hover table-nomargin table-bordered table-colored-header">
                                <thead>
                                    
                                    <tr>
                                        <th>Código</th>
                                        <th>Tipo</th>
                                        <th>Nome</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Valor</th>
                                        <th>Pagamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->id}}</td>
                                        <td>{{$payment->tipo}}</td>
                                        <td>{{$payment->nome}}</td>
                                        <td>{{$payment->cpf_cnpj}}</td>
                                        <td>{{$payment->valor}}</td>
                                        <td>{{$payment->dt_pagamento}}</td>
                                        <td>

                                            <form action="{{route('recebimento.destroy', ['Payment' => $payment->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                @csrf
                                                @method('delete')
                                                <a href="{{route('recebimento.edit', ['payment' => $payment->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar">
                                                    <i class="icon-edit"></i>
                                                </a>
                                                <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $payments->links('layouts.pagination') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
