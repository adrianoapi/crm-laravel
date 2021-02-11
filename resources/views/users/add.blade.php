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
                                    <label for="nome" class="control-label">Nome completo</label>
                                    <div class="controls">
                                        <input type="text" name="nome" id="nome" placeholder="Text input" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="email" class="control-label">E-mail</label>
                                    <div class="controls">
                                        <input type="text" name="email" id="email" placeholder="Text input" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="telefone" class="control-label">Telefone</label>
                                    <div class="controls">
                                        <input type="text" name="telefone" id="telefone" placeholder="Text input" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="password" class="control-label">Senha</label>
                                    <div class="controls">
                                        <input type="password" name="password" id="password" placeholder="Password input" class="input-xlarge">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Basic</label>
                                    <div class="controls">
                                        <select name="s2" id="s2" class='select2-me input-xlarge'>
                                            <option value="01">Administrador</option>
                                            <option value="02">Usuario</option>
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
