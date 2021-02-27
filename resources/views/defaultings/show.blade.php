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
                            <h3><i class="icon-th-list"></i> {{$title}}: {{$defaulting->student->name}}</h3>
                        </div>
                        <div class="box-content nopadding">
                            <div class="tabs-container">
                                <ul class="tabs tabs-inline tabs-top">
                                    <li class='active'>
                                        <a href="#aluno" data-toggle='tab'><i class="icon-user"></i> Aluno</a>
                                    </li>
                                    <li>
                                        <a href="#negociacao" data-toggle='tab'><i class="icon-lock"></i> Negociação</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content padding tab-content-inline tab-content-bottom">

                                <div class="tab-pane" id="negociacao">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Negociado</th>
                                                    <th>Material</th>
                                                    <th>Total</th>
                                                    <th>Serviço</th>
                                                    <th>Total</th>
                                                    <th>Multa</th>
                                                    <th>Total</th>
                                                    <th>Adicionar</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php
                                                        if($defaulting->student->negociado){
                                                            echo '<button class="btn btn-small  btn-success">SIM</button>';
                                                        }else{
                                                            echo '<button class="btn btn-small  btn-danger">NÃO</button>';
                                                        }
                                                    ?></td>
                                                    <td>{{$defaulting->m_parcelas}}/{{$defaulting->m_parcelas - $defaulting->m_parcela_pg}}</td>
                                                    <td>
                                                        <?php
                                                            $valor = str_replace(',', '.', str_replace('.', '', $defaulting->m_parcela_valor));
                                                            $valor = ($defaulting->m_parcelas - $defaulting->m_parcela_pg) * $valor;
                                                            echo number_format($valor, 2, ',', '.');
                                                        ?>
                                                    </td>
                                                    <td>{{$defaulting->s_parcelas}}/{{$defaulting->s_parcelas - $defaulting->s_parcela_pg}}</td>
                                                    <td>
                                                        <?php
                                                            $valor = str_replace(',', '.', str_replace('.', '', $defaulting->s_parcela_valor));
                                                            $valor_total = ($defaulting->s_parcelas - $defaulting->s_parcela_pg) * $valor;
                                                            echo number_format($valor_total, 2, ',', '.');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $multa = str_replace(',', '.', str_replace('.', '', $defaulting->multa));
                                                            $multa = $multa * $valor_total / 100;
                                                            echo number_format($multa, 2, ',', '.');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $total = $valor_total + $multa;
                                                            echo number_format($total, 2, ',', '.');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <span class="add_form_field btn btn-teal">Parcela &nbsp;
                                                            <span  span style="font-size:16px; font-weight:bold;">+ </span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <form action="{{route('defaultings.destroy', ['defaulting' => $defaulting->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                            @csrf
                                                            @method('delete')

                                                            <a href="{{route('defaultings.edit', ['defaulting' => $defaulting->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar">
                                                                <i class="icon-edit"></i>
                                                            </a>

                                                            <button type="submit" class="btn btn-red" rel="tooltip" title="" data-original-title="Excluir">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <form action="{{route('defaultingTradings.store')}}" method="POST" class='form-vertical'>
                                            @csrf
                                            <input type="hidden" name="defaulting_id" value="{{$defaulting->id}}">
                                            <div class="row-fluid container1">

                                            @foreach ($defaulting->defaultingTradings as $value)
                                            <div class="row-fluid">
                                                <div class="span2">
                                                    <div class="control-group">
                                                        <label for="parcela" class="control-label">Parcela</label>
                                                        <div class="controls controls-row">
                                                            <input type="number" name="parcela[]" value="{{$value->parcela}}" id="parcela" placeholder="00" class="input-block-level" required="">                    </div>
                                                    </div>
                                                </div>
                                                <div class="span2">
                                                    <div class="control-group">
                                                        <label for="data" class="control-label">Data</label>
                                                        <div class="controls controls-row">
                                                            <input type="text" name="vencimento[]" value="{{$value->vencimento}}" id="vencimento" placeholder="00/00/0000" class="date input-block-level" required="" maxlength="10">                    </div>
                                                    </div>
                                                </div>
                                                <div class="span2">
                                                    <div class="control-group">
                                                        <label for="valor" class="control-label">Valor</label>
                                                        <div class="controls controls-row">
                                                            <input type="text" name="valor[]" value="{{$value->valor}}" id="valor" placeholder="100,00" class="money input-block-level" required="">                    </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="delete">Delete</a>
                                            </div>
                                            @endforeach

                                            </div>

                                            <div class="row-fluid">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                    <a href="{{route('defaultings.index')}}" class="btn">Cancelar</a>
                                                </div>
                                            </div>
                                        </form>
                                </div>

                                <div class="tab-pane active" id="aluno">
                                    <form action="{{route('alunos.update', ['student' => $student[0]->id])}}" method="POST" class='form-vertical'>
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="defaulting_id" value="{{$defaulting->id}}">
                                    <div class="row-fluid">
                                        <div class="span1">
                                            <div class="control-group">
                                                <label for="cod_unidade" class="control-label">Unidade*</label>
                                                <div class="controls controls-row">
                                                    <input type="text" name="cod_unidade" id="cod_unidade" placeholder="00000"  value="{{$student[0]->cod_unidade}}" max="100" class="input-block-level">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span1">
                                            <div class="control-group">
                                                <label for="cod_curso" class="control-label">Curso*</label>
                                                <div class="controls controls-row">
                                                    <input type="text" name="cod_curso" id="cod_curso" placeholder="00000"  value="{{$student[0]->cod_curso}}" max="100" class="input-block-level">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                                                <label for="name" class="control-label">Nome completo*</label>
                                                <div class="controls controls-row">
                                                    <input type="text" name="name" id="name"  value="{{$student[0]->name}}" placeholder="Insira o nome" max="100" class="input-block-level" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="control-group">
                                                <label for="nascimento" class="control-label">Nacimento</label>
                                                <div class="controls controls-row">
                                                    <input type="text" name="nascimento" id="nascimento"  value="{{$student[0]->nascimento}}" placeholder="(00) 0000-0000" max="20" class="date input-block-level">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="control-group">
                                                <label for="cpf_cnpj" class="control-label">CPF/CNPJ*</label>
                                                <div class="controls controls-row">
                                                    <input type="text" name="cpf_cnpj" id="cpf_cnpj"  value="{{$student[0]->cpf_cnpj}}" placeholder="000.000.000-00/0000" max="30" class="input-block-level">
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
                                                    <input type="text" name="cep" id="cep"  value="{{$student[0]->cep}}" placeholder="00000000" max="9" class="input-block-level" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span8">
                                            <div class="control-group">
                                            <label for="endereco" class="control-label">Endereço*<samll><b><a href="javascript:void(0)" onClick="consultaCep()" id="a_cep">Auto completar</a></b></small></label>
                                                <div class="controls controls-row">
                                                    <input type="text" name="endereco" id="endereco"  value="{{$student[0]->endereco}}" placeholder="Endereço" max="255" class="input-block-level" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="control-group">
                                                <label for="numero" class="control-label">Número*</label>
                                                <div class="controls controls-row">
                                                    <input type="number" name="numero" id="numero"  value="{{$student[0]->numero}}" placeholder="Número" max="99999" class="input-block-level" >
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
                                                    <input type="text" name="bairro" id="bairro"  value="{{$student[0]->bairro}}" placeholder="bairro" max="255" class="input-block-level" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="control-group">
                                                <label for="cidade" class="control-label">Cidade*</label>
                                                <div class="controls controls-row">
                                                    <input type="text" name="cidade" id="cidade"  value="{{$student[0]->cidade}}" placeholder="cidade" max="255" class="input-block-level" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="control-group">
                                                <label for="estado" class="control-label">Estado*</label>
                                                <div class="controls controls-row">
                                                    <select name="estado" id="estado" class='select2-me input-block-level' required>
                                                        @foreach($estados as $key => $value)
                                                        <option value="{{$key}}"  {{$key == $student[0]->estado ? 'selected':''}}>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span2">
                                            <div class="control-group">
                                                <label for="negociado" class="control-label">Negociado*</label>
                                                <div class="controls controls-row">
                                                    <select name="negociado" id="negociado" class='select2-me input-block-level' required>
                                                        <option value="true" {{$student[0]->negociado ? 'selected':''}}>SIM</option>
                                                        <option value="false" {{!$student[0]->negociado ? 'selected':''}}>NÃO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="control-group">
                                                <label for="observacao" class="control-label">Observação</label>
                                                <div class="controls controls-row">
                                                    <textarea name="observacao" id="observacao" placeholder="observacao..." class="input-block-level">{{$student[0]->observacao}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                            <a href="{{route('defaultings.index')}}" class="btn">Cancelar</a>
                                        </div>
                                    </div>
                                </form>


@include('students.cep')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row-fluid">

                <div class="span12">
                    <div class="box box-bordered box-color">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Histórico</h3>
                        </div>
                        <div class="box-content nopadding">

                        <textarea name="history" id="history" rows="5" class="input-block-level" placeholder="Descreva a negociação..."></textarea>
                        <button type="button" class="btn btn-primary" onclick="saveHistory()">Registrar</button>
                        <p></div>

                        <div class="box-content nopadding">

                            <table id="history-table" class="table table-hover table-nomargin table-colored-header">

                                <tbody>
                                @foreach ($defaulting->defaultingHistories as $value)
                                <tr>
                                    <td>
                                    Data: <strong>{{$value->created_at}}</strong>&nbsp;-&nbsp;Usuário: <strong>{{$value->user->name}}</strong>
                                    <p>{{$value->observacao}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>

                            </table>

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
                inputs += '                        <input type="text" name="vencimento[]" id="vencimento" placeholder="00/00/0000" class="date input-block-level" required>';
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

            // Mascaras formulario
            (function( $ ) {
            $(function() {
                $('.date').mask('00/00/0000');
                $('.money').mask('#.##0,00', {reverse: true});
            });
            })(jQuery);

            // Registrar historico
            function saveHistory()
            {
                var value = $("#history").val();
                $.ajax({
                    url: "{{route('defaultingHistories.store')}}",
                    type: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "observacao": value,
                        "defaulting_id": {{$defaulting->id}},
                    },
                    dataType: 'json',
                        success: function(data){
                            console.log(data);
                            inserirLinha(data['attributes']);
                        }
                });
            }

            function inserirLinha(data)
            {
                var html = "";
                html +=  'Data: <strong>'+data['created_at']+'</strong>&nbsp;-&nbsp;';
                html +=  'Usuário: <strong>{{Auth::user()->name}}</strong>';
                html +=  '<p>'+data['observacao']+'</p>';
                $("#history-table").prepend("<tr><td>"+html+"</td></tr>");
            }

            </script>


        </div>
    </div>

</div>
@endsection
