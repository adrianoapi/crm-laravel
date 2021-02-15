@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid" id="content">

    @include('layouts.navigation')

    <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">
                    <div class="box box-bordered box-color">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> {{$title}}</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="{{route('unidades.store')}}" method="POST" class='form-horizontal form-bordered'>
                            @csrf
                            <div class="control-group">
                                <label for="name" class="control-label">Nome</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" placeholder="Insira o nome" class="input-xlarge" required>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <a href="{{route('unidades.index')}}" class="btn">Cancelar</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
