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
                                <a href="{{route('segundaFase.create')}}" class="btn btn-primary">
                                <i class="icon-reorder"></i> Novo</a>
                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-colored-header">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Negociado</th>
                                        <th>Material</th>
                                        <th>Serviço</th>
                                        <th>Multa</th>
                                        <th>Total</th>
                                        <th class='hidden-350'>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($segundas as $value)
                                    <tr>
                                        <td>{{$value->student->name}}</td>
                                        <td><?php
                                            if($value->student->negociado){
                                                echo '<button class="btn btn-small  btn-success">SIM</button>';
                                            }else{
                                                echo '<button class="btn btn-small  btn-danger">NÃO</button>';
                                            }
                                        ?></td>
                                        <td>{{$value->m_parcela_total}}</td>
                                        <td>{{$value->s_parcela_total}}</td>
                                        <td>{{$value->multa}}</td>
                                        <td>{{$value->total}}</td>
                                        <td class='hidden-1024'>
                                            <form action="{{route('segundaFase.destroy', ['SegundaFase' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                @csrf
                                                @method('delete')
                                                <a href="{{route('segundaFase.edit', ['SegundaFase' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar">
                                                    <i class="icon-edit"></i>
                                                </a>
                                                <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir">
                                                    <i class="icon-trash"></i>
                                                </button>
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
