<div id="navigation">
    <div class="container-fluid">
    <a href="{{route('history.index')}}" id="brand">CRM System</a>
        <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>

        <ul class='main-nav'>
            @if(Auth::user()->level > 1)
            <li>
                <a href="{{route('caixa.index')}}">CAIXA</a>
            </li>
            <li>
                <a href="{{route('caixa.byDay')}}">CAIXA DIÁRIO</a>
            </li>
            <li>
                <a href="{{route('caixa.unidade')}}">CAIXA UNIDADE</a>
            </li>
            @endif
            <li>
                <a href="{{route('defaultings.index')}}">CONTRATO - EVOLUTIME</a>
            </li>
            <li>
                <a href="{{route('bankCheques.index')}}">CHEQUE - EVOLUTIME</a>
            </li>
            <li>
                <a href="{{route('graphics.index')}}">GRAFICA - ENNT</a>
            </li>
            <li>
                <a href="{{route('recebimento.index')}}">RECEBIMENTO</a>
            </li>
            <li>
                <a href="{{route('history.index')}}">RETORNO</a>
            </li>
        </ul>

        <div class="user">
            <ul class="icon-nav">

                <li class="dropdown sett">
                    <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i></a>
                    <ul class="dropdown-menu pull-right theme-settings">
                        <li>
                            <span>Importações</span>
                                <a href="{{route('importacao.history',['modulo'=>'cheque'])}}" >Cheque</a>
                                <a href="{{route('importacao.history',['modulo'=>'contrato'])}}" >Contrato</a>
                                <a href="{{route('importacao.history',['modulo'=>'grafica'])}}" >Gráfica</a>
                        </li>
                    </ul>
                </li>
                <li class='dropdown colo'>
                    <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
                    <ul class="dropdown-menu pull-right theme-colors">
                        <li class="subtitle">
                            Predefined colors
                        </li>
                        <li>
                            <span class='red'></span>
                            <span class='orange'></span>
                            <span class='green'></span>
                            <span class="brown"></span>
                            <span class="blue"></span>
                            <span class='lime'></span>
                            <span class="teal"></span>
                            <span class="purple"></span>
                            <span class="pink"></span>
                            <span class="magenta"></span>
                            <span class="grey"></span>
                            <span class="darkblue"></span>
                            <span class="lightred"></span>
                            <span class="lightgrey"></span>
                            <span class="satblue"></span>
                            <span class="satgreen"></span>
                        </li>
                    </ul>
                </li>

            </ul>
            <div class="dropdown">
                <a href="#" class='dropdown-toggle' data-toggle="dropdown">{{Auth::user()->name}}</a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="{{route('usuarios.profile')}}"><i class="icon-user"></i> Perfil</a>
                    </li>
                    <li>
                        <a href="{{route('login.logout')}}"><i class="icon-off"></i> Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
