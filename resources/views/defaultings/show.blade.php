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
                                <a href="{{route('defaultings.index')}}" class="btn btn-primary">
                                <i class="icon-reorder"></i> Voltar</a>
                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-colored-header">
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
                        </div>

                    </div>
                </div>
            </div>



            <div class="row-fluid">
                <div class="span12">
                    <div class="box box-bordered">
                        <div class="box-content">
                            <form action="{{route('defaultings.store')}}" method="POST" class='form-vertical'>

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
                    </div>
                </div>
            </div>

<script>

$(document).ready(function() {
    var max_fields = 20;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");
    var inputs = '';
    inputs += '        <div class="row-fluid">';
    inputs += '           <div class="span2">';
    inputs += '                <div class="control-group">';
    inputs += '                   <label for="parcela" class="control-label">Parcela</label>';
    inputs += '                    <div class="controls controls-row">';
    inputs += '                        <input type="number" name="parcela[]" id="parcela" placeholder="00" max="100" step="1"  class="input-block-level" required>';
    inputs += '                    </div>';
    inputs += '                </div>';
    inputs += '            </div>';
    inputs += '            <div class="span2">';
    inputs += '                <div class="control-group">';
    inputs += '                    <label for="data" class="control-label">Data</label>';
    inputs += '                   <div class="controls controls-row">';
    inputs += '                        <input type="number" name="data[]" id="data" placeholder="00/00/0000" max="255" step="1"  class="input-block-level" required>';
    inputs += '                    </div>';
    inputs += '                </div>';
    inputs += '            </div>';
    inputs += '           <div class="span2">';
    inputs += '                <div class="control-group">';
    inputs += '                    <label for="valor" class="control-label">Valor</label>';
    inputs += '                    <div class="controls controls-row">';
    inputs += '                        <input type="number" name="valor[]" id="valor" placeholder="00" max="20" step="1"  class="input-block-level" required>';
    inputs += '                    </div>';
    inputs += '               </div>';
    inputs += '            </div>';
    inputs += '       <a href="#" class="delete">Delete</a></div>';

    var x = 1;
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

@endsection
