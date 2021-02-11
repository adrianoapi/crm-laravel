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
                            <h3><i class="icon-th-list"></i> {{$titleForm}}</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="#" method="POST" class='form-horizontal form-bordered'>
                            <div class="control-group">
                                    <label for="name" class="control-label">Nome completo</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" placeholder="Insira o nome" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="email" class="control-label">E-mail</label>
                                    <div class="controls">
                                        <input type="text" name="email" id="email" placeholder="name@provider.domain" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="password" class="control-label">Senha</label>
                                    <div class="controls">
                                        <input type="password" name="password" id="password" placeholder="Insira uma senha" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="level" class="control-label">Nível</label>
                                    <div class="controls">
                                        <select name="level" id="level" class='select2-me input-xlarge'>
                                            <option value="3">Proprietário</option>
                                            <option value="2">Gerente</option>
                                            <option value="1">Atendente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn">Cancelar</button>
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
