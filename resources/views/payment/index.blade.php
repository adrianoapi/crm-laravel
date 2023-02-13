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
                                    <form action="{{route('recebimento.index')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                        <input type="hidden" name="filtro" id="filtro" value="pesquisa">
                                    <tr>
                                        <th class="span2">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <div class="controls controls-row">
                                                            <input id="codigo" placeholder="codigo" type="text" name="codigo" value="{{$codigo}}" class="input-block-level">
                                                        </div>
                                                    </div>
                                                </div>
										    </div>
                                        </th>
                                        <th>
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <select name="tipo" id="tipo" class='input-block-level'>
                                                            <option value="">Tipo?</option>
                                                            @foreach($tiposTecebimentos as $key => $value)
                                                                <option value="{{$key}}" {{$key == $tipo ? 'selected' : NULL}}>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="nome" placeholder="Nome" type="text" name="nome" value="{{$nome}}" class="input-block-level">
                                                    </div>
                                                </div>
										    </div>
                                        </th>
                                        <th>
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="cpf" placeholder="CPF/CNPJ" type="text" name="cpf" value="{{$cpf}}" class="input-block-level">
                                                    </div>
                                                </div>
										    </div>
                                        </th>
                                        <th colspan="2">
                                            <div class="span6">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="dt_inicio" placeholder="{{date('01/m/Y')}}" type="text" name="dt_inicio" value="{{$dt_inicio}}" class="input-block-level datepick" require>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="dt_fim" placeholder="{{date('t/m/Y')}}" type="text" name="dt_fim" value="{{$dt_fim}}" class="input-block-level datepick" require>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <span class="input-group-append">
                                                            <button type="submit" class="btn btn-sm" style="margin-top:-10px;">Pesquisar</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </th>
                                    </tr>
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
                                        <td>{{$tiposTecebimentos[$payment->tipo]}}</td>
                                        <td>{{$payment->nome}}</td>
                                        <td>{{$payment->cpf_cnpj}}</td>
                                        <td>{{$payment->valor}}</td>
                                        <td>{{$payment->dt_pagamento}}</td>
                                        <td>

                                            <form action="{{route('recebimento.destroy', ['Payment' => $payment->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                              
                                                
                                                <a href="{{route('recebimento.print', ['payment' => $payment->id])}}" target="_blank" class="btn" rel="tooltip" title="" data-original-title="Imprimir">
                                                    <i class="icon-download"></i>
                                                </a>
                                                <!--<a href="{{route('recebimento.edit', ['payment' => $payment->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar">
                                                    <i class="icon-edit"></i>
                                                </a>
                                                <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir">
                                                    <i class="icon-trash"></i>
                                                </button>-->
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


<script>

    // Mascaras formulario
    (function( $ ) {
    $(function() {
        $('.date').mask('00/00/0000');
    });
    })(jQuery);
    
    
    
    $(document).ready(function () {
        $(document).on('focus', '.datepick', function () {
            $(this).datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR'
            });
        });
    });
    
    $('.datepick').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR'
    });
    
    </script>
@endsection
