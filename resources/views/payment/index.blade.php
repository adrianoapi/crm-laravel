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

                                <form action="{{route('graphics.csv')}}" method="GET" class="span12" style="margin: 0;padding:0;">
                                
                                    <a href="{{route('recebimento.create')}}" class="btn btn-primary">
                                        <i class="icon-reorder"></i> Novo
                                    </a>
                                </form>
                            </span>
                            <span class="tabs">

                            </span>
                        </div>

                        <div class="box-content nopadding">
                            <table class="table table-hover table-nomargin table-bordered table-colored-header">
                                <thead>
                                    
                                    <tr>
                                        <th>Código</th>
                                        <th>Tipo</th>
                                        <th>Nome</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Valor</th>
                                        <th>Pagamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>
                            {{ $payments->links('layouts.pagination') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
