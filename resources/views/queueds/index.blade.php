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

                            @if(!count($queueds))
                               <form enctype="multipart/form-data" action="{{route('importacao.upload')}}" method="POST" class="span12" style="margin: 0;padding:0;">
                                    @csrf

                                    <label>Upload Arquivo CSV</label>
                                    <input size='50' type='file' name='filename'>
                                    <input type='submit' name='submit' value='Enviar CSV'>

                                </form>
                            @else
                            <form action="{{route('importacao.destroy', ['queued' => $queueds[0]->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('importacao.index',    ['queued'   => $queueds[0]->id])}}" class="btn-success btn" rel="tooltip" title="" data-original-title="Salver registros">Registrar fila <i class="icon-save"></i></a>
                                    <button type="submit" class="btn-danger btn" rel="tooltip" title="" data-original-title="Excluir registros">Excluir fila <i class="icon-trash"></i></button>
                                </form>
                            @endif

                            </span>
                            <span class="tabs">

                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-bordered table-colored-header">
                                <thead>
                                    <th>Linha</th>
                                    <th>Pessoa</th>
                                    <th>Valor</th>
                                    <th>Cheque</th>
                                </thead>
                                <tbody>
                                <?php

                                foreach($queueds as $queued):

                                    $body = json_decode($queued->body);
                                    $i=0;
                                    foreach($body as $value):

                                ?>
                                    <tr>
                                        <td style="vertical-align: top">{{++$i}}</td>
                                        <td style="vertical-align: top">
                                            <strong>unidade:</strong> {{$value->students->cod_unidade}}<br>
                                            <strong>nome:</strong> {{$value->students->name}}<br>
                                            <strong>cod:</strong> {{$value->students->cod_curso}}<br>
                                            <strong>ctr:</strong> {{$value->students->ctr}}<br>
                                            <strong>cpf/cnpj:</strong> {{$value->students->cpf_cnpj}}<br>
                                            <strong>telefones:</strong> [{{$value->students->telefone}}] [{{$value->students->telefone_com}}] [{{$value->students->celular}}]<br>
                                        </td>
                                        <td style="vertical-align: top">
                                            <strong>valor:</strong> {{$value->bank_cheques->valor}}
                                        </td>
                                        <td>
                                            @foreach($value->bank_cheque_plots as $plot)
                                            <ul>
                                                <li><strong>banco:</strong> {{$plot->banco}}</li>
                                                <li><strong>agencia:</strong> {{$plot->agencia}}</li>
                                                <li><strong>conta:</strong> {{$plot->conta}}</li>
                                                <li><strong>cheque:</strong> {{$plot->cheque}}</li>
                                                <li><strong>vencimento:</strong> {{$plot->vencimento}}</li>
                                                <li><strong>valor:</strong> {{$plot->valor}}</li>
                                            </ul>
                                            @endforeach()
                                        </td>
                                    </tr>

                                <?php
                                    endforeach;
                                endforeach;
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


@endsection
