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
                                <a href="{{route('usuarios.create')}}" class="btn btn-primary">
                                <i class="icon-reorder"></i> Novo</a>
                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-colored-header">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th class='hidden-350'>Level</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td class='hidden-350'>{{$levels[$value->level]}}</td>
                                        <td class='hidden-1024'>
                                            <form action="{{route('usuarios.destroy', ['User' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                @csrf
                                                @method('delete')
                                                <a href="{{route('usuarios.edit', ['User' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar">
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
