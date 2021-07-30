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
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-bordered table-colored-header table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <form action="{{route('caixa.unidade')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                            <input type="hidden" name="pagamento" value="sim">
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
                                        <th>

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
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Unidade</th>
                                        <th>Grafica</th>
                                        <th>Segunda</th>
                                        <th>Terceira</th>
                                        <th>Cheque</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($caixa as $key => $value)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>
                                                <?php
                                                $total = 0;
                                                if(array_key_exists('grafica', $value))
                                                {
                                                    echo $value['grafica']['valor_pago'];
                                                    $total += $value['grafica']['valor_pago'];
                                                }else{
                                                    echo '0,00';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if(array_key_exists('contrato', $value))
                                                {
                                                    if(array_key_exists('segunda', $value['contrato']))
                                                    {
                                                        echo $value['contrato']['segunda']['valor_pago'];
                                                        $total += $value['contrato']['segunda']['valor_pago'];
                                                    }else{
                                                        echo '0,00';
                                                    }
                                                }else{
                                                    echo '0,00';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if(array_key_exists('contrato', $value))
                                                {
                                                    if(array_key_exists('terceira', $value['contrato']))
                                                    {
                                                        echo $value['contrato']['terceira']['valor_pago'];
                                                        $total += $value['contrato']['terceira']['valor_pago'];
                                                    }else{
                                                        echo '0,00';
                                                    }
                                                }else{
                                                    echo '0,00';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if(array_key_exists('cheque', $value))
                                                {
                                                    echo $value['cheque']['valor_pago'];
                                                    $total += $value['cheque']['valor_pago'];
                                                }else{
                                                    echo '0,00';
                                                }
                                                ?>
                                            </td>
                                            <td>{{number_format($total, 2, ',', '.')}}</td>
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
