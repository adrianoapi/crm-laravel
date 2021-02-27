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
                            <span class="tabs">
                                <form action="{{route('defaultings.index')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                    <div class="input-group span12">
                                        <input type="hidden" name="filtro" value="pesquisa">
                                        <input placeholder="Search" type="text" name="pesquisar" value="{{$pesuisar}}" class="form-control form-control-sm">
                                        <span class="input-group-append">
                                            <button type="submit" style="margin-top:-10px;" class="btn btn-sm btn-primary">Go!</button>
                                        </span>
                                    </div>
                                </form>
                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-colored-header">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Negociado</th>
                                        <th>Fones</th>
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
                                        <td><a href="{{route('defaultings.show', ['defaulting' => $value->id])}}" target="_parent">{{$value->student->name}}</a></td>
                                        <td><?php
                                            if($value->student->negociado){
                                                echo '<button class="btn btn-small  btn-success">SIM</button>';
                                            }else{
                                                echo '<button class="btn btn-small  btn-danger">NÃO</button>';
                                            }
                                        ?></td>
                                        <td>{{$value->student->telefone}}/{{$value->student->celular}}</td>
                                        <td>
                                            <?php
                                                $valor = str_replace(',', '.', str_replace('.', '', $value->m_parcela_valor));
                                                $valor = ($value->m_parcelas - $value->m_parcela_pg) * $valor;
                                                echo number_format($valor, 2, ',', '.');
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $valor = str_replace(',', '.', str_replace('.', '', $value->s_parcela_valor));
                                                $valor_total = ($value->s_parcelas - $value->s_parcela_pg) * $valor;
                                                echo number_format($valor_total, 2, ',', '.');
                                            ?>
                                        </td>
                                        <td><?php
                                                $multa = str_replace(',', '.', str_replace('.', '', $value->multa));
                                                $multa = $multa * $valor_total / 100;
                                                echo number_format($multa, 2, ',', '.');
                                            ?></td>
                                        <td><?php
                                                $total = $valor_total + $multa;
                                                echo number_format($total, 2, ',', '.');
                                            ?></td>
                                        <td class='hidden-1024'>
                                            <form action="{{route('defaultings.destroy', ['defaulting' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                @csrf
                                                @method('delete')
                                                <?php if($value->student->negociado){ ?>
                                                    <a href="{{route('defaultings.show', ['defaulting' => $value->id])}}" class="btn btn-lime" rel="tooltip" title="" data-original-title="Negociar">
                                                        <i class="icon-credit-card"></i> Negociar
                                                    </a>
                                                <?php }else{ ?>
                                                    <a href="{{route('defaultings.show', ['defaulting' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Negociar">
                                                        <i class="icon-credit-card"></i> Negociar
                                                    </a>
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
                            {{ $defaultings->links('layouts.pagination') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
