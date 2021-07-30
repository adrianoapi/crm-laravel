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
                                            <form action="{{route('caixa.byDay')}}" method="GET" class="span12" style="margin: 0;padding:0;">
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
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <select name="modulo" id="modulo" class='input-block-level'>
                                                            <option value="" {{$modulo == '' ? 'selected':''}}>Modulo?</option>
                                                            <option value="contrato_segunda" {{$modulo == 'contrato_segunda' ? 'selected':''}}>2ª Fase</option>
                                                            <option value="contrato_terceira" {{$modulo == 'contrato_terceira' ? 'selected':''}}>3ª Fase</option>
                                                            <option value="cheque" {{$modulo == 'cheque' ? 'selected':''}}>CHEQUE</option>
                                                            <option value="grafica" {{$modulo == 'grafica' ? 'selected':''}}>GRAFICA</option>
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
                                        <th>Semana</th>
                                        <th>Dia</th>
                                        <th>Valor</th>
                                        <th>Módulo</th>
                                        <th>#</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                if(!empty($calendario_inicio) && !empty($calendario_fim)){



                                    $inicio = new DateTime($calendario_inicio);
                                    $fim = new DateTime($calendario_fim);
                                    $fim->modify('+1 day');

                                    $interval = new DateInterval('P1D');
                                    $periodo  = new DatePeriod($inicio, $interval ,$fim);

                                    foreach($periodo as $data){
                                        ?>

                                        <tr>
                                            <td>{{$data->format("l")}}</td>
                                            <td>{{$data->format("d/m")}}</td>
                                            <td>
                                            <?php
                                            if(array_key_exists($data->format("d/m/Y"), $caixa))
                                            {
                                                echo '<strong>'.number_format($caixa[$data->format("d/m/Y")]['valor_pago'], 2, ',', '.').'</strong>';
                                            }else{
                                                echo '0,00';
                                            }
                                            ?>
                                            </td>
                                            <td>
                                                @if(!empty($modulo))
                                                    @if($modulo == 'contrato_segunda')
                                                        Segunda
                                                    @elseif($modulo == 'contrato_terceira')
                                                        Terceira
                                                    @else
                                                        {{$modulo}}
                                                    @endif
                                                @else
                                                    Todos
                                                @endif

                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php

                                    }

                                }



                                ?>
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
