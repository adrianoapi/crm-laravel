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
                            <div class="tabs-container">
                                <ul class="tabs tabs-inline tabs-left">
                                    <li class='active'>
                                        <a href="#first" data-toggle='tab'><i class="icon-lock"></i> Negociação</a>
                                    </li>
                                    <li>
                                        <a href="#second" data-toggle='tab'><i class="icon-user"></i> Aluno</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content padding tab-content-inline">

                                <div class="tab-pane active" id="first">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Material</th>
                                                    <th>Serviço</th>
                                                    <th>Multa</th>
                                                    <th>Total</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$defaulting->student->name}}</td>
                                                    <td>{{$defaulting->m_parcela_total}}</td>
                                                    <td>{{$defaulting->s_parcela_total}}</td>
                                                    <td>{{$defaulting->multa}}</td>
                                                    <td>{{$defaulting->total}}</td>
                                                    <td><span class="add_form_field btn btn-teal">Adicionar Parcela &nbsp;
                                                            <span  span style="font-size:16px; font-weight:bold;">+ </span>
                                                        </span></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <form action="{{route('defaultingTradings.store')}}" method="POST" class='form-vertical'>
                                            @csrf
                                            <input type="hidden" name="defaulting_id" value="{{$defaulting->id}}">
                                            <div class="row-fluid container1">

                                            </div>

                                            <div class="row-fluid">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                    <a href="{{route('defaultings.index')}}" class="btn">Cancelar</a>
                                                </div>
                                            </div>
                                        </form>
                                </div>

                                <div class="tab-pane" id="second">
                                    <form action="{{route('alunos.update', ['student' => $student[0]->id])}}" method="POST" class='form-vertical'>
                                        @csrf
                                        @method('PUT')

                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label for="unity_id" class="control-label">Unidade</label>
                                                    <div class="controls controls-row">
                                                    <input type="text" name="unity_id" id="unity_id"  value="{{$student[0]->unity->name}}" placeholder="Insira o nome" max="100" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label for="name" class="control-label">Nome completo*</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="name" id="name"  value="{{$student[0]->name}}" placeholder="Insira o nome" max="100" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="nascimento" class="control-label">Nacimento</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="nascimento" id="nascimento"  value="{{$student[0]->nascimento}}" placeholder="(00) 0000-0000" max="20" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="cpf_cnpj" class="control-label">CPF/CNPJ*</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="cpf_cnpj" id="cpf_cnpj"  value="{{$student[0]->cpf_cnpj}}" placeholder="000.000.000-00/0000" max="30" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="ctr" class="control-label">CTR</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="ctr" id="ctr"  value="{{$student[0]->ctr}}" placeholder="000000" max="20" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label for="responsavel" class="control-label">Responsável</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="responsavel" id="responsavel"  value="{{$student[0]->responsavel}}" placeholder="Insira o nome do responsável" max="100" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label for="email" class="control-label">E-mail</label>
                                                    <div class="controls controls-row">
                                                        <input type="email" name="email" id="email"  value="{{$student[0]->email}}" placeholder="Insira o e-mail" max="255" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="telefone" class="control-label">Telefone Fixo</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="telefone" id="telefone"  value="{{$student[0]->telefone}}" placeholder="(00) 0000-0000" max="20" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="telefone_com" class="control-label">Telefone Comercial</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="telefone_com" id="telefone_com"  value="{{$student[0]->telefone_com}}" placeholder="(00) 0000-0000" max="20" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="celular" class="control-label">Telefone celular</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="celular" id="celular"  value="{{$student[0]->celular}}" placeholder="(00) 00000-0000" max="20" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row-fluid">
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="cep" class="control-label">CEP*</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="cep" id="cep"  value="{{$student[0]->cep}}" placeholder="00000000" max="9" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span8">
                                                <div class="control-group">
                                                <label for="endereco" class="control-label">Endereço*<samll><b><a href="javascript:void(0)" onClick="consultaCep()" id="a_cep">Auto completar</a></b></small></label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="endereco" id="endereco"  value="{{$student[0]->endereco}}" placeholder="Endereço" max="255" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="numero" class="control-label">Número*</label>
                                                    <div class="controls controls-row">
                                                        <input type="number" name="numero" id="numero"  value="{{$student[0]->numero}}" placeholder="Número" max="99999" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="complemento" class="control-label">Complemento*</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="complemento" id="textfield"  value="{{$student[0]->complemento}}" placeholder="complemento" max="20" class="input-block-level">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span4">
                                                <div class="control-group">
                                                    <label for="bairro" class="control-label">Bairro*</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="bairro" id="bairro"  value="{{$student[0]->bairro}}" placeholder="bairro" max="255" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span4">
                                                <div class="control-group">
                                                    <label for="cidade" class="control-label">Cidade*</label>
                                                    <div class="controls controls-row">
                                                        <input type="text" name="cidade" id="cidade"  value="{{$student[0]->cidade}}" placeholder="cidade" max="255" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label for="estado" class="control-label">Estado*</label>
                                                    <div class="controls controls-row">
                                                    <input type="text" name="cidade" id="estado"  value="{{$student[0]->estado}}" placeholder="estado" max="255" class="input-block-level" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


<script>

$(document).ready(function() {
    var x = 1;
    var max_fields = 20;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");
    var inputs = '';
    inputs += '        <div class="row-fluid">';
    inputs += '           <div class="span2">';
    inputs += '                <div class="control-group">';
    inputs += '                   <label for="parcela" class="control-label">Parcela</label>';
    inputs += '                    <div class="controls controls-row">';
    inputs += '                        <input type="number" name="parcela[]" id="parcela" placeholder="00" class="input-block-level" required>';
    inputs += '                    </div>';
    inputs += '                </div>';
    inputs += '            </div>';
    inputs += '            <div class="span2">';
    inputs += '                <div class="control-group">';
    inputs += '                    <label for="data" class="control-label">Data</label>';
    inputs += '                   <div class="controls controls-row">';
    inputs += '                        <input type="text" name="data[]" id="data" placeholder="00/00/0000" class="date input-block-level" required>';
    inputs += '                    </div>';
    inputs += '                </div>';
    inputs += '            </div>';
    inputs += '           <div class="span2">';
    inputs += '                <div class="control-group">';
    inputs += '                    <label for="valor" class="control-label">Valor</label>';
    inputs += '                    <div class="controls controls-row">';
    inputs += '                        <input type="text" name="valor[]" id="valor" placeholder="100,00"  class="money input-block-level" required>';
    inputs += '                    </div>';
    inputs += '               </div>';
    inputs += '            </div>';
    inputs += '       <a href="#" class="delete">Delete</a></div>';

    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;

            //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="delete">Delete</a></div>'); //add input box
            $(wrapper).append(inputs); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
</script>


        </div>
    </div>

</div>
<script>
(function( $ ) {
  $(function() {
    $('.date').mask('00/00/0000');
    $('.money').mask('#.##0,00', {reverse: true});
  });
})(jQuery);

</script>
@endsection
