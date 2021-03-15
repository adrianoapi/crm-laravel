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
                                <form action="{{route('bankCheques.pdf')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                    <input placeholder="Nome ou cpf" type="hidden" name="pesquisar" value="{{$pesuisar}}" class="input-block-level">
                                    <input placeholder="unidade" type="hidden" name="unidade" value="{{$unidade}}" class="input-block-level">
                                    <input placeholder="ctr" type="hidden" name="ctr" value="{{$ctr}}" class="input-block-level">
                                    <input placeholder="negociado" type="hidden" name="negociado" value="{{$negociado}}" class="input-block-level">
                                    <input placeholder="boleto" type="hidden" name="boleto" value="{{$boleto}}" class="input-block-level">
                                    <input type="hidden" name="filtro" id="filtro" value="pesquisa">


                                    @if(count($bankCheques) > 0 && array_key_exists('filtro', $_GET))
                                        <button type="submit" class="btn btn-success" style="margin-top:-10px;">
                                            <i class="icon-reorder"></i> PDF
                                        </button>
                                    @else
                                        <a href="{{route('bankCheques.create')}}" class="btn btn-primary">
                                            <i class="icon-reorder"></i> Novo
                                        </a>
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
                                        <th colspan="1">
                                            <form action="{{route('bankCheques.index')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input type="hidden" name="filtro" id="filtro" value="pesquisa">
                                                        <input id="pesquisar" placeholder="Nome ou cpf" type="text" name="pesquisar" value="{{$pesuisar}}" class="input-block-level">
                                                    </div>
                                                </div>
										    </div>
                                        </th>
                                        <th colspan="1">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="unidade" placeholder="unidade" type="text" name="unidade" value="{{$unidade}}" class="input-block-level">
                                                    </div>
                                                </div>
										    </div>
                                        </th>
                                        <th colspan="1">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <input id="ctr" placeholder="ctr" type="text" name="ctr" value="{{$ctr}}" class="input-block-level">
                                                    </div>
                                                </div>
										    </div>
                                        </th>
                                        <th colspan="1">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <select name="negociado" id="negociado" class='input-block-level'>
                                                            <option value="" {{$negociado == '' ? 'selected':''}}>Negociado?</option>
                                                            <option value="sim" {{$negociado == 'sim' ? 'selected':''}}>Sim</option>
                                                            <option value="nao" {{$negociado == 'nao' ? 'selected':''}}>Não</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="1">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <div class="controls controls-row">
                                                        <select name="boleto" id="boleto" class='input-block-level'>
                                                            <option value="" {{$boleto == '' ? 'selected':''}}>Boleto?</option>
                                                            <option value="sim" {{$boleto == 'sim' ? 'selected':''}}>Sim</option>
                                                            <option value="nao" {{$boleto == 'nao' ? 'selected':''}}>Não</option>
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
                                        <th>Nome</th>
                                        <th>Negociado</th>
                                        <th>Boleto</th>
                                        <th>Fones</th>
                                        <th>Valor</th>
                                        <th class='hidden-350'>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($bankCheques as $value)
                                    <tr>
                                        <td>
                                            <a href="{{route('bankCheques.show', ['bankCheque' => $value->id])}}" target="_parent">{{$value->student->name}}</a>
                                            <br><small>Unid: {{$value->student->cod_unidade}} / Curso: {{$value->student->cod_curso}} / CTR: {{$value->student->ctr}} / CPF: {{$value->student->cpf_cnpj}}</small>
                                        </td>
                                        <td><?php

                                            if($value->negociado){
                                                echo '<button class="btn btn-small  btn-success">SIM</button>';
                                            }else{
                                                echo '<button class="btn btn-small  btn-danger">NÃO</button>';
                                            }
                                        ?></td>
                                        <td><?php
                                            if($value->boleto){
                                                echo '<button class="btn btn-small  btn-success">SIM</button>';
                                            }else{
                                                echo '<button class="btn btn-small  btn-danger">NÃO</button>';
                                            }
                                        ?></td>
                                        <td>{{$value->student->telefone}}/{{$value->student->celular}}</td>
                                        <td>{{$value->valor}}</td>
                                        <td class='hidden-1024'>
                                            <?php if($value->student->negociado){ ?>
                                                <a href="{{route('bankCheques.show', ['bankCheque' => $value->id])}}" class="btn btn-lime" rel="tooltip" title="" data-original-title="Negociar">
                                                    <i class="icon-credit-card"></i>
                                                </a>
                                            <?php }else{ ?>
                                                <a href="{{route('bankCheques.show', ['bankCheque' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Negociar">
                                                    <i class="icon-credit-card"></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $bankCheques->links('layouts.pagination') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
