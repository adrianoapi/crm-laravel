<div class="box-content nopadding">
    <table class="table table-nomargin table-bordered">
       <thead>
        <tr>
            <th>Tutorial de importação:</th>
        </tr>
       </thead>
       <tbody>
        <tr>
            <td>
                <li>Antes de converter seu excel para csv, certifique-se de que não haja vírgula, ponto e vírgula, apóstrofo ou caracteres especiais, tais como ç, ã, ê,í, ò, ü... </li>
            </td>
        </tr>
        <tr>
            <td>
                <li>O arquivo deve ser de extensão ".CSV".</li>
                <li>O mesmo deve ser separado por ";".</li>
                <li>Caso haja dúvida, clique com o botão direito do mouse sobre o arquivo, mande abrir com o bloco de notas, então deverá aparecer o conteúdo separado por ";" como no exemplo da imagem.
                    <img src="{!! asset('img-1.jpg') !!}">
                </li>
            </td>
        </tr>
        <tr>
            <td>
                <li>Campo email: pode ter ".", "@" e "_";</li>
                <li>Campo data: pode pode ser formato BR <strong>dd/mm/aaaa</strong> ou formato USA <strong>aaaa-mm-dd</strong>;</li>
                <li>Campo nome: linhas que não possuem este campo preenchdio, serão ignoradas;</li>
                <li>Campos monetários: devem ter o formato <strong>0.00</strong> ou apenas <strong>00</strong>, não pode haver separação por vírgula, apenas <strong>"."</strong>;</li>
            </td>
        </tr>
        <tr>
            <td>
                @if($modulo == 'grafica')
                    <a href="modelo_grafica_2023.csv">Clique aqui,</a>
                @endif
                @if($modulo == 'contrato')
                    <a href="modelo_contrato_2023.csv">Clique aqui,</a>
                @endif
                para fazer o downlaod do arquivo csv de exemplo do módulo <strong>{{$modulo}}</strong></td>
        </tr>
       </tbody>
    </table>
</div>