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
                                <form enctype="multipart/form-data" action="{{route('importacao.upload')}}" method="POST" class="span12" style="margin: 0;padding:0;">
                                @csrf


                                <label>Upload Product CSV file Here</label>

                                <input size='50' type='file' name='filename'>
                                </br>
                                <input type='submit' name='submit' value='Enviar CSV'>

                                </form>
                            </span>
                            <span class="tabs">

                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-bordered table-colored-header">

                                <tbody>
                                <?php
                                $body = json_decode($queued[0]->body);
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
