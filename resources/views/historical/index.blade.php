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

                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-nomargin table-bordered table-colored-header">
                                <tbody>
                                    <thead>
                                        <th>Nome</th>
                                        <th>Data</th>
                                        <th>Módulo</th>
                                        <th>Contato</th>
                                        <th>Ação</th>
                                    </thead>
                                    @foreach($historical as $value)
                                        <tr>
                                            <td>
                                            @if($value->modulo == 'cheque')
                                            <a href="{{route('bankCheques.show', ['graphic' => $value->modulo_id])}}" target="_blank">{{$value->name}}</a>
                                            @elseif($value->modulo == 'contrato')
                                            <a href="{{route('defaultings.show', ['defaulting' => $value->modulo_id])}}" target="_blank">{{$value->name}}</a>
                                            @else
                                            <a href="{{route('graphics.show', ['graphic' => $value->modulo_id])}}" target="_blank">{{$value->name}}</a>
                                            @endif
                                            </td>
                                            <td>{{$value->created_at}}</td>
                                            <td>
                                                @if($value->modulo == 'cheque')
                                                    Cheque
                                                @elseif($value->modulo == 'contrato')
                                                    {{ucfirst($value->fase)}}
                                                @else
                                                    Grafica
                                                @endif
                                            </td>
                                            <td>{{$value->observacao}}</td>
                                            <td>
                                                <form action="{{route('history.update')}}" method="POST" onSubmit="return confirm('Deseja encerrar?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('post')
                                                    <input type="hidden" name="id" value="{{$value->id}}">
                                                    <input type="hidden" name="modulo" value="{{$value->modulo}}">
                                                    <button type="submit" class="btn btn-primary" rel="tooltip" title="" data-original-title="Encerrar"><i class="fa fa-trash"></i> Encerrar</button>
                                                </form>
                                            </td>
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
