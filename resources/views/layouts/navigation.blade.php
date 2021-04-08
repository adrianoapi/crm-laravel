<div id="left">

			<div class="subnav">
                @if(Auth::user()->level > 1)
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Administração</span></a>
				</div>
				<ul class="subnav-menu">
					<li>
						<a href="{{route('usuarios.index')}}">Usuarios</a>
					</li>
					<!--<li>
						<a href="{{route('alunos.index')}}">Alunos</a>
					</li>-->
				</ul>
                @endif
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Financeiro</span></a>
				</div>
				<ul class="subnav-menu">
                    @if(Auth::user()->level > 1)
                    <li>
                        <a href="{{route('caixa.index')}}">CAIXA</a>
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
				</ul>
			</div>

		</div>
