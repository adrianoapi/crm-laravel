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
                                <a href="{{route('defaultings.create')}}" class="btn btn-primary">
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
                                @foreach ($defaultings as $value)
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
                                            <form action="{{route('defaultings.destroy', ['defaulting' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                @csrf
                                                @method('delete')
                                                <?php if($value->student->negociado){ ?>
                                                    <a href="{{route('defaultings.show', ['defaulting' => $value->id])}}" class="btn btn-lime" rel="tooltip" title="" data-original-title="Negociar">
                                                        <i class="icon-credit-card"></i> Negociar
                                                    </a>
                                                <?php }else{ ?>
                                                    <span class="btn" rel="tooltip" title="" data-original-title="Negociar">
                                                        <i class="icon-credit-card"></i> Negociar
                                                    </span>
                                                <?php } ?>

                                                <button type="submit" class="btn btn-red" rel="tooltip" title="" data-original-title="Excluir">
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