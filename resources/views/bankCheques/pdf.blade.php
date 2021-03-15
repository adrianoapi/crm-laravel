<table border=1>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Negociado</th>
            <th>Boleto</th>
            <th>Fones</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($bankCheques as $value)
        <tr>
            <td>
                {{$value->student->name}}
                <br><small>Unid: {{$value->student->cod_unidade}} / Curso: {{$value->student->cod_curso}} / CTR: {{$value->student->ctr}} / CPF: {{$value->student->cpf_cnpj}}</small>
            </td>
            <td><?php

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
            <td>{{$value->valor}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
