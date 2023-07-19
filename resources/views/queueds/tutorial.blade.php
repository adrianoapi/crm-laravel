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
                <li>Deixe o arquivo com no máximo 1000 linhas, se necessário, divida-o em outros arquivos, deixando sempre o cabeçalho em cada um deles;</li>
            </td>
        </tr>
        <tr>
            <td>
                <li>O arquivo deve ser de extensão ".CSV".</li>
                <li>O mesmo deve ser separado por ";".</li>
                <li>Caso haja dúvida, clique com o botão direito do mouse sobre o arquivo, mande abrir com o bloco de notas, então deverá aparecer o conteúdo separado por ";" como no exemplo da imagem.
                    <img src="{!! asset('img-1.jpg') !!}" align="leftgit">
                </li>
            </td>
        </tr>
        <tr>
            <td>
                <li>Campo email: pode ter ".", "@" e "_";</li>
                <li>Campo data: pode pode ser formato BR <strong>dd/mm/aaaa</strong> ou formato USA <strong>aaaa-mm-dd</strong>;</li>
                <li>Campo nome: linhas que não possuem este campo preenchdio, serão ignoradas;</li>
                <li>Campos monetários: devem ter o formato <strong>0.00</strong>, <strong>0,00</strong> ou apenas <strong>00</strong>;</li>
            </td>
        </tr>
        <tr>
            <td>
                <h5>Possíveis erros</h5>
                <li>0 linhas registradas: o arquivo está em branco ou não está separado por ponto e vírgula;</li>
                <li>erro de query:
                    <ul>
                        <li>pode está faltando alguma coluna no arquivo, tal como tipo ou fase;</li>
                        <li>pode haver algum caractere diferente de UTF-8 ou ponto e vígula em algum cadastro, o que faz o sistema entender que tem coluna quebrada;</li>
                    </ul>
                </li>
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