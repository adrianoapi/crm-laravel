@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid" id="content">

    @include('layouts.navigation')

    <div id="main">
        <div class="container-fluid">

			<div class="row-fluid">
				<div class="span12">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3><i class="icon-th-list"></i> {{$title}}</h3>
						</div>
						<div class="box-content">
                            <form action="{{route('defaultings.update', ['defaulting' => $defaulting->id])}}" method="POST" class='form-vertical'>
                                @csrf
                                @method('PUT')

								<div class="row-fluid">
									<div class="span10">
										<div class="control-group">
											<label for="student_id" class="control-label">Aluno</label>
											<div class="controls controls-row">
												<select name="student_id" id="student_id" class='select2-me input-block-level' required>
													@foreach($students as $student)
													<option value="{{$student->id}}" {{$student->id == $defaulting->student_id ? 'selected':''}}>{{$student->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
                                    <div class="span2">
										<div class="control-group">
											<label for="dt_inadimplencia" class="control-label">Data inadimplencia</label>
											<div class="controls controls-row">
												<input type="text" name="dt_inadimplencia" id="dt_inadimplencia" value="{{$defaulting->dt_inadimplencia}}" placeholder="00/00/0000" max="10" class="input-block-level" required>
											</div>
										</div>
									</div>
								</div>

                                <h5>Material</h5>
								<div class="row-fluid">
                                    <div class="span2">
										<div class="control-group">
											<label for="m_parcela" class="control-label">Parcelas</label>
											<div class="controls controls-row">
												<input type="number" name="m_parcela" id="m_parcela" value="{{$defaulting->m_parcela}}"  placeholder="00" max="100" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
                                    <div class="span2">
										<div class="control-group">
											<label for="m_parcela_pg" class="control-label">Parcelas Pagas</label>
											<div class="controls controls-row">
												<input type="number" name="m_parcela_pg" id="m_parcela_pg" value="{{$defaulting->m_parcela_pg}}" placeholder="00" max="255" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
									<div class="span2">
										<div class="control-group">
											<label for="m_parcela_ab" class="control-label">Parcelas Abertas</label>
											<div class="controls controls-row">
												<input type="number" name="m_parcela_ab" id="m_parcela_ab" value="{{$defaulting->m_parcela_ab}}" placeholder="00" max="20" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
                                    <div class="span3">
										<div class="control-group">
											<label for="m_parcela_valor" class="control-label">Valor Parcela</label>
											<div class="controls controls-row">
												<input type="text" name="m_parcela_valor" id="m_parcela_valor" value="{{$defaulting->m_parcela_valor}}" placeholder="00.00" max="20" step=".01" class="money input-block-level" required>
											</div>
										</div>
									</div>
									<div class="span3">
										<div class="control-group">
											<label for="m_parcela_total" class="control-label">Total</label>
											<div class="controls controls-row">
												<input type="text" name="m_parcela_total" id="m_parcela_total" value="{{$defaulting->m_parcela_total}}" placeholder="00.00" max="20" step=".01" class="money input-block-level" required>
											</div>
										</div>
									</div>
								</div>

                                <h5>Serviço</h5>
								<div class="row-fluid">
                                    <div class="span2">
										<div class="control-group">
											<label for="s_parcela" class="control-label">Parcelas</label>
											<div class="controls controls-row">
												<input type="number" name="s_parcela" id="s_parcela" value="{{$defaulting->s_parcela}}" placeholder="00" max="100" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
                                    <div class="span2">
										<div class="control-group">
											<label for="s_parcela_pg" class="control-label">Parcelas Pagas</label>
											<div class="controls controls-row">
												<input type="number" name="s_parcela_pg" id="s_parcela_pg" value="{{$defaulting->s_parcela_pg}}" placeholder="00" max="255" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
									<div class="span2">
										<div class="control-group">
											<label for="s_parcela_ab" class="control-label">Parcelas Abertas</label>
											<div class="controls controls-row">
												<input type="number" name="s_parcela_ab" id="s_parcela_ab" value="{{$defaulting->s_parcela_ab}}" placeholder="00" max="20" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
                                    <div class="span3">
										<div class="control-group">
											<label for="s_parcela_valor" class="control-label">Valor Parcela</label>
											<div class="controls controls-row">
												<input type="text" name="s_parcela_valor" id="s_parcela_valor" value="{{$defaulting->s_parcela_valor}}" placeholder="00.00" max="20" step=".01" class="money input-block-level" required>
											</div>
										</div>
									</div>
									<div class="span3">
										<div class="control-group">
											<label for="s_parcela_total" class="control-label">Total</label>
											<div class="controls controls-row">
												<input type="text" name="s_parcela_total" id="s_parcela_total" value="{{$defaulting->s_parcela_total}}" placeholder="00.00" max="20" step=".01" class="money input-block-level" required>
											</div>
										</div>
									</div>
								</div>

								<div class="row-fluid">
                                    <div class="span2">
                                        <div class="control-group">
                                            <label for="multa" class="control-label">Multa</label>
                                            <div class="controls controls-row">
                                                <input type="text" name="multa" id="multa" value="{{$defaulting->multa}}" placeholder="00.00" max="20" step=".01"  class="money input-block-level" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <div class="control-group">
                                            <label for="total" class="control-label">Total</label>
                                            <div class="controls controls-row">
                                                <input type="text" name="total" id="total" value="{{$defaulting->total}}" placeholder="00.00" max="20" step=".01"  class="money input-block-level" required>
                                            </div>
                                        </div>
                                    </div>
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


        </div>
    </div>

</div>

<script>

(function( $ ) {
  $(function() {
    $('#dt_inadimplencia').mask('00/00/0000');
    $('.money').mask('#.##0,00', {reverse: true});
  });
})(jQuery);
</script>

@include('students.cep')

@endsection
