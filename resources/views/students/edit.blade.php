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
                            <form action="{{route('alunos.update', ['student' => $student->id])}}" method="POST" class='form-horizontal form-bordered'>
                                @csrf
                                @method('PUT')
                                <div class="control-group">
                                    <label for="unity_id" class="control-label">Unidade</label>
                                    <div class="controls">
                                        <select name="unity_id" id="unity_id" class='select2-me input-xlarge' required>
                                            @foreach($unities as $unity)
                                            <option value="{{$unity->id}}" {{$unity->id == $student->unity_id ? 'selected':''}}>{{$unity->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="name" class="control-label">Nome completo</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" value="{{$student->name}}" placeholder="Insira o nome" class="input-xlarge" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="cpf_cnpj" class="control-label">CPF/CNPJ</label>
                                    <div class="controls">
                                        <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{{$student->cpf_cnpj}}" placeholder="cpf ou cnpj" class="input-xlarge" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="responsavel" class="control-label">Responsável</label>
                                    <div class="controls">
                                        <input type="text" name="responsavel" id="responsavel" value="{{$student->responsavel}}" placeholder="Insira o nome do responsável" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a href="{{route('alunos.index')}}" class="btn">Cancelar</a>
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
