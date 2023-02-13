<style>
.table{
    margin-left: auto;
    margin-right: auto;
    border: 2px #000 solid;
    width: 600px;
    padding-top: 5px;
    padding-bottom: 5px;
}
.tableDois{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    padding-top: 10px;
}
th, td {
  padding: 0px;
  margin: 0px;
}
.tiulo{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 22px;
    font-weight: bold;
}

.colunaValor{
    linhaValor
}
.linhaValor1{
    min-width: 250px;
}
.linhaValor3{
    min-width: 50px;
}
.linhaValorFundo{
    background-color: darkgrey;
}
    </style>
<p>&nbsp;</p>

<?php

function valorPorExtenso( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false )
    {
 
        $valor = str_replace(",","",$valor);
 
        $singular = null;
        $plural = null;
 
        if ( $bolExibirMoeda )
        {
            $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }
        else
        {
            $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }
 
        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezessete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
 
 
        if ( $bolPalavraFeminina )
        {
        
            if ($valor == 1) 
            {
                $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }
            else 
            {
                $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }
            
            
            $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
            
            
        }
 
 
        $z = 0;
 
        $valor = number_format( $valor, 2, ".", "." );
        $inteiro = explode( ".", $valor );
 
        for ( $i = 0; $i < count( $inteiro ); $i++ ) 
        {
            for ( $ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ ) 
            {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }
 
        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $rt = null;
        $fim = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
        for ( $i = 0; $i < count( $inteiro ); $i++ )
        {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
 
            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count( $inteiro ) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ( $valor == "000")
                $z++;
            elseif ( $z > 0 )
                $z--;
                
            if ( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) )
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
                
            if ( $r )
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }
 
        $rt = mb_substr( $rt, 1 );
 
        return($rt ? trim( $rt ) : "zero");
 
    }

    $mes_extenso = array(
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Março',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    );


    # Tratar moeda
    $valor = $payment->valor;
    $valorFloat = str_replace(',', '.', str_replace('.', '', $valor));

    # Tratar data
    $data = explode('/', $payment->dt_pagamento);

    # Tratar Número
    $novoId = $payment->id;
    if(strlen($payment->id) < 6)
    {
        $novoId = NULL;
        for($i = 0; $i < (6 - strlen($payment->id)); $i++){
            $novoId = $novoId."0";
        }
        $novoId = $novoId.$payment->id;
    }

?>
<table class="table">
    <tr>
        <td colspan="5" class="tiulo">RECIBO Nº {{$novoId}}</td>
    </tr>
    <tr>
        <td colspan="2" class="linhaValor1 linhaValorFundo"></td>
        <td class="tiulo">VALOR:</td>
        <td class="tiulo" align="right">R$ <?php echo $valor; ?> </td>
        <td class="linhaValor3 linhaValorFundo"></td>
    </tr>
    <tr>
        <td colspan="5">
            
            <table width="100%" class="tableDois">
                <tr>
                    <td VALIGN="TOP" style="width:20%"><strong>Recebi de:</strong></td>
                    <td>{{$payment->nome}}</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td VALIGN="TOP" style="width:20%"><strong>CPF/CNPJ:</strong></td>
                    <td>{{$payment->cpf_cnpj}}</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td VALIGN="TOP" style="width:20%"><strong>Valor de:</strong></td>
                    <td><?php echo ucfirst(valorPorExtenso($valorFloat)); ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td VALIGN="TOP" style="width:20%"><strong>Referente:</strong></td>
                    <td>{{$payment->descricao}}</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">E pela clareza firmo o presente</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        São Paulo, {{$data[0]}} de {{$mes_extenso[$data[1]]}} de {{$data[2]}}
                        <br><br>____________________________
                        <br>Assinatura
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" VALIGN="TOP">Nome: {{$payment->beneficiado_nome}}</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" VALIGN="TOP">CPF/CNPJ: {{$payment->beneficiado_cpf_cnpj}}</td>
                </tr>
            </table>

        </td>
    </tr>
</table>