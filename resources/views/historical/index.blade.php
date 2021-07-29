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
                                        <th>Data</th>
                                        <th>Módulo</th>
                                        <th>Contato</th>
                                        <th>Ação</th>
                                    </thead>
                                    @foreach($historical as $history)
                                        <tr>
                                            <td>{{$history->created_at}}</td>
                                            <td>{{$history->modulo}}</td>
                                            <td>{{$history->observacao}}</td>
                                            <td>
                                                <form action="{{route('history.update')}}" method="POST" onSubmit="return confirm('Deseja encerrar?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('post')
                                                    <input type="hidden" name="id" value="{{$history->id}}">
                                                    <input type="hidden" name="modulo" value="{{$history->modulo}}">
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
