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
                        <form action="{{route('bankCheques.update', ['bankCheque' => $bankCheque->id])}}" method="POST" class='form-vertical'>
                                @csrf
                                @method('PUT')

								<div class="row-fluid">
									<div class="span10">
										<div class="control-group">
											<label for="student_id" class="control-label">Aluno</label>
											<div class="controls controls-row">
                                                <input type="text" name="name" id="name" value="{{$bankCheque->student->name}}" placeholder="nome aluno" max="10" class="input-block-level" disabled>
                                                <input type="hidden" name="student_id" value="{{$bankCheque->student_id}}">
											</div>
										</div>
									</div>
                                    <div class="span2">
										<div class="control-group">
											<label for="dt_vencimento" class="control-label">Data dvencimento</label>
											<div class="controls controls-row">
												<input type="text" name="dt_vencimento" id="dt_vencimento" value="{{$bankCheque->dt_vencimento}}" placeholder="00/00/0000" max="10" class="input-block-level" required>
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid">
                                    <div class="span2">
										<div class="control-group">
											<label for="banco" class="control-label">Banco</label>
											<div class="controls controls-row">
												<input type="text" name="banco" id="banco" value="{{$bankCheque->banco}}" placeholder="00" max="100" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
                                    <div class="span2">
										<div class="control-group">
											<label for="agencia" class="control-label">Agência</label>
											<div class="controls controls-row">
												<input type="text" name="agencia" id="agencia" value="{{$bankCheque->agencia}}" placeholder="00" max="100" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
                                    <div class="span2">
										<div class="control-group">
											<label for="cheque" class="control-label">Cheque</label>
											<div class="controls controls-row">
												<input type="text" name="cheque" id="cheque" value="{{$bankCheque->cheque}}" placeholder="00" max="100" step="1"  class="input-block-level" required>
											</div>
										</div>
									</div>
                                    <div class="span3">
										<div class="control-group">
											<label for="valor" class="control-label">Valor Cheque</label>
											<div class="controls controls-row">
												<input type="text" name="valor" id="valor" value="{{$bankCheque->valor}}" placeholder="00,00"  max="100" step=".01" class="money input-block-level" required>
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Salvar</button>
										<a href="{{route('bankCheques.show', ['bankCheque' => $bankCheque->id])}}" class="btn">Cancelar</a>
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
    $('#dt_vencimento').mask('00/00/0000');
    $('.money').mask('#.##0,00', {reverse: true});
  });
})(jQuery);

</script>

@include('students.cep')

@endsection
