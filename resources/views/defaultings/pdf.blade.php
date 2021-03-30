<table border=1>
    <thead>
        <tr>
            <th>Fase</th>
            <th>Uni</th>
            <th>Cod</th>
            <th>Ctr</th>
            <th>Cpf</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Comercial</th>
            <th>Negociado</th>
            <th>Boleto</th>
            <th>Total Líquido</th>
            <th>Total Geral</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($defaultings as $value)
        <tr>
            <td>{{$value->fase}}</td>
            <td>{{$value->student->cod_unidade}}</td>
            <td>{{$value->student->cod_curso}}</td>
            <td>{{$value->student->ctr}}</td>
            <td>{{$value->student->cpf_cnpj}}</td>
            <td>{{$value->student->name}}</td>
            <td>{{$value->student->telefone}}</td>
            <td>{{$value->student->celular}}</td>
            <td>{{$value->student->comercial}}</td>
            <td><?php

                $m_parcelas = $value->m_parcelas;
                $m_parcela_pg = $value->m_parcela_pg;
                $m_pendente = $value->m_parcelas - $value->m_parcela_pg;
                $m_parcela_valor = $value->m_parcela_valor;

                $s_parcelas = $value->s_parcelas;
                $s_parcela_pg = $value->s_parcela_pg;
                $s_pendente = $value->s_parcelas - $value->s_parcela_pg;
                $s_parcela_valor = $value->s_parcela_valor;

                if($value->negociado){
                    echo 'SIM';
                }else{
                    echo 'NÃO';
                }
            ?></td>
            <td><?php
                if($value->boleto){
                    echo 'SIM';
                }else{
                    echo 'NÃO';
                }
            ?></td>
            <td>{{$value->student->telefone}}/{{$value->student->celular}}</td>
            <td>
                <?php
                    #Total Líquido
                    $valor = str_replace(',', '.', str_replace('.', '', $s_parcela_valor));
                    $s_valor_total = ($value->s_parcelas - $value->s_parcela_pg) * $valor;

                    $multa = str_replace(',', '.', str_replace('.', '', $value->multa));
                    $multa = $multa * $s_valor_total / 100;

                    $valor = str_replace(',', '.', str_replace('.', '', $m_parcela_valor));
                    $m_valor_total = ($m_parcelas - $m_parcela_pg) * $valor;

                    $total = $m_valor_total + $multa;
                    echo number_format($total, 2, ',', '.');
                ?>
            </td>
            <td>
                <?php
                #Total Geral
                $total = $m_valor_total + $s_valor_total;
                echo number_format($total, 2, ',', '.');
                ?>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
