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
                                        <th colspan="3">
                                            <form action="{{route('caixa.index')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="dt_inicio" placeholder="{{date('01/m/Y')}}" type="text" name="dt_inicio" value="{{$dt_inicio}}" class="input-block-level datepick" require>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="2">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="dt_fim" placeholder="{{date('t/m/Y')}}" type="text" name="dt_fim" value="{{$dt_fim}}" class="input-block-level datepick" require>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="4">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <select name="pagamento" id="pagamento" class='input-block-level'>
                                                            <option value="sim" {{($pagamento)  ? 'selected':''}}>Pagamento Sim</option>
                                                            <option value="nao" {{!($pagamento) ? 'selected':''}}>Pagamento Não</option>
                                                        </select>
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
                                        <th>Módulo</th>
                                        <th>Unidade</th>
                                        <th>Curso</th>
                                        <th>CTR</th>
                                        <th>Nome</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Parcela</th>
                                        <th>Dt Pagamento</th>
                                        <th>{{($pagamento)  ? 'Pago' : 'À Receber'}}</th>
                                        <th>Pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0; ?>
                                @foreach ($caixa as $value)
                                <?php $total = ($pagamento) ? $total + $value->valor_pago : $total + $value->valor;?>
                                    <tr>
                                        <td>
                                        @if($value->modulo == 'cheque')
                                            Cheque
                                        @elseif($value->modulo == 'contrato')
                                            {{ucfirst($value->fase)}}
                                        @else
                                            Grafica
                                        @endif
                                        </td>
                                        <td>{{$value->cod_unidade}}</td>
                                        <td>{{$value->cod_curso}}</td>
                                        <td>{{$value->ctr}}</td>
                                        <td>
                                        @if($value->modulo == 'cheque')
                                        <a href="{{route('bankCheques.show', ['graphic' => $value->id])}}" target="_blank">{{$value->name}}</a>
                                        @elseif($value->modulo == 'contrato')
                                        <a href="{{route('defaultings.show', ['defaulting' => $value->id])}}" target="_blank">{{$value->name}}</a>
                                        @else
                                        <a href="{{route('graphics.show', ['graphic' => $value->id])}}" target="_blank">{{$value->name}}</a>
                                        @endif
                                        </td>
                                        <td>{{$value->cpf_cnpj}}</td>
                                        <td>{{$value->parcela}}</td>
                                        <td>{{$value->dt_pagamento}}</td>
                                        <td>{{($pagamento) ? $value->valor_pago : $value->valor}}</td>
                                        <td>{{$value->pagamento}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td><strong>Total</strong></td>
                                        <td colspan="2"><strong>{{number_format($total, 2, ',', '.')}}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
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