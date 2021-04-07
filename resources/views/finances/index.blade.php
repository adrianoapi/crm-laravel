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

                                <form action="{{route('graphics.pdf')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                    <input type="hidden" name="filtro" id="filtro" value="pesquisa">


                                    @if(count($caixa) > 0 && array_key_exists('filtro', $_GET))
                                        <button type="submit" class="btn btn-success" style="margin-top:-10px;">
                                            <i class="icon-reorder"></i> PDF
                                        </button>
                                    @endif
                                </form>
                            </span>
                            <span class="tabs">

                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-bordered table-colored-header">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <form action="{{route('caixa.index')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input type="hidden" name="data_inicio" id="data_inicio" value="data_inicio">
                                                        <input id="pesquisar" placeholder="{{date('01/m/Y')}}" type="text" name="pesquisar" value="" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="2">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input type="hidden" name="data_inicio" id="data_inicio" value="data_inicio">
                                                        <input id="pesquisar" placeholder="{{date('t/m/Y')}}" type="text" name="pesquisar" value="" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="2">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <select name="boleto" id="boleto" class='input-block-level'>
                                                            <option value="">selecione pagamento...</option>
                                                            <option value="sim">Sim</option>
                                                            <option value="nao">Não</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="6">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <span class="input-group-append">
                                                            <button type="submit" class="btn btn-sm" style="margin-top:-10px;">Pesquisar</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>fase</th>
                                        <th>unidade</th>
                                        <th>curso</th>
                                        <th>ctr</th>
                                        <th>name</th>
                                        <th>cpf_cnpj</th>
                                        <th>parcela</th>
                                        <th>valor</th>
                                        <th>vencimento</th>
                                        <th>dt_pagamento</th>
                                        <th>valor_pago</th>
                                        <th>pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($caixa as $value)
                                    <tr>
                                        <td>{{$value->fase}}</td>
                                        <td>{{$value->cod_unidade}}</td>
                                        <td>{{$value->cod_curso}}</td>
                                        <td>{{$value->ctr}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->cpf_cnpj}}</td>
                                        <td>{{$value->parcela}}</td>
                                        <td>{{$value->valor}}</td>
                                        <td>{{$value->vencimento}}</td>
                                        <td>{{$value->dt_pagamento}}</td>
                                        <td>{{$value->valor_pago}}</td>
                                        <td>{{$value->pagamento}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
