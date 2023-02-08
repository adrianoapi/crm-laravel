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
                            <form action="{{route('usuarios.store')}}" method="POST" class='form-horizontal form-column form-bordered'>
                            @csrf
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="nome" class="control-label">Nome Pagador</label>
                                        <div class="controls">
                                            <input type="text" name="nome" id="nome" placeholder="Insira o nome" class="input-xlarge" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="cpf_cnpj" class="control-label">CPF/CNPJ</label>
                                        <div class="controls">
                                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" placeholder="000.000.000/00" class="input-xlarge" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="valor" class="control-label">Valor</label>
                                        <div class="controls">
                                            <input type="text" name="valor" id="valor" placeholder="0,00" class="money input-xlarge" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="dt_pagamento" class="control-label">Data</label>
                                        <div class="controls">
                                            <input type="text" name="dt_pagamento" id="dt_pagamento" value="{{date('dd/mm/YYYY')}}" placeholder="dd/mm/aaaa" class="input-xlarge" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="descricao" class="control-label">Descrição</label>
                                        <div class="controls">
                                            <textarea name="descricao" id="descricao" rows="5" class="input-block-level" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="beneficiado_nome" class="control-label">Nome</label>
                                        <div class="controls">
                                            <input type="text" name="beneficiado_nome" id="beneficiado_nome" placeholder="Nome do beneficiado" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="beneficiado_cpf_cnpj" class="control-label">CPF/CNPJ</label>
                                        <div class="controls">
                                            <input type="text" name="beneficiado_cpf_cnpj" id="beneficiado_cpf_cnpj" placeholder="Dados do beneficiado" class="input-xlarge">
                                        </div>
                                    </div>  
                                    <div class="control-group">
                                        <label for="tipo" class="control-label">Tipo</label>
                                        <div class="controls">
                                            <select name="tipo" id="tipo" class='select2-me input-xlarge' required>
                                                @foreach($tiposTecebimentos as $id => $recebimento)
                                                <option value="{{$id}}">{{$recebimento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="separador" class="control-label">&nbsp;</label>
                                        <div class="controls">
                                        </div>
                                    </div>
                                </div>
                                <div class="span12">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                        <a href="{{route('recebimento.index')}}" class="btn">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
(function( $ ) {
  $(function() {
    $('#dt_pagamento').mask('00/00/0000');
    $('.money').mask('#.##0,00', {reverse: true});
  });
})(jQuery);

</script>

@endsection
