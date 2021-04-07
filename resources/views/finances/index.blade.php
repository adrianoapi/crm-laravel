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
