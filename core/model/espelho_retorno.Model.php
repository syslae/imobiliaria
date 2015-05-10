
<?

class Relatorio extends ADODB_Active_Record
{
    var $DB;
    function __construct()
    {
        include (DOMAIN_PATH.'config/conexaoFc.php');
        //global $DB;
        $this->DB = $DB;

    }

    function __destruct()
    {
        //$this->DB->Close();
    }

    public function situacaoRetorno($valor, $Tamanho, $Sigla){
        if($Tamanho == 400 && $Sigla == 'BN'){
            $dados = array(
                2 => 'ENTRADA CONFIRMADA',
                4 => 'ALTERAÇÃO.',
                6 => 'LIQUIDAÇÃO NORMAL.',
                7 => 'PAGAMENTO POR CONTA.',
                8 => 'PAGAMENTO POR CARTÓRIO.',
                9 => 'BAIXA SIMPLES.',
                10=> 'DEVOLVIDO - PROTESTADO',
                11=> 'EM SER.',
                12=> 'ABATIMENTO CONCEDIDO.',
                13=> 'ABATIMENTO CANCELADO.',
                14=> 'VENCIMENTO ALTERADO.',
                15=> 'BAIXA AUTOMÁTICA',
                18=> 'ALTERAÇÃO DEPOSITÁRIA.',
                19=> 'CONFIRMAÇÃO DE PROTESTO.',
                20=> 'CONFIRMAÇÃO DE SUSTAR-PROTESTO.',
                21=> 'ALTERAÇÃO INFORMAÇÕES DE CONTROLE DA EMPRESA',
                22=> 'ALTERAÇÃO "SEU NÚMERO".',
                51=> 'ENTRADA REJEITADA.',
                54=> 'ERRO - CONCESSÃO DE ABATIMENTO');
        }

        if($Tamanho == 240 && $Sigla == 'BN'){
            $dados = array(
                2 => 'ENTRADA CONFIRMADA',
                3 => 'ENTRADA REJEITADA',
                6 => 'LIQUIDAÇÃO NORMAL.',
                7 => 'CONFIRMAÇÃO DE RECEB. INSTRUC. DESCONTO',
                8 => 'CONFIRMAÇÃO DE RECEB. CANC. INSTRUC. DESCONTO',
                9 => 'BAIXA',
                10=> 'CONF. RECEB. INSTRUC. REPACTUAÇÃO',
                12=> 'CONF. RECEB. INSTRUC. ABATIMENTO',
                13=> 'CONF. RECEB. INSTRUC. CANCEL. ABATIMENTO',
                14=> 'CONF. RECEB. INSTRUC. ALTERA. VENCIMENTO',
                17=> 'LIQUIDAÇÃO APÓS BAIXA OU TITULO NÃO REGISTRADO.',
                26=> 'INSTRUÇÃO REJEITADA',
                27=> 'CONF. PEDIDO DE ALTERA. DADOS',
                30=> 'ALTERA. DADOS REJEITADA');
        }

        if($Tamanho == 240 && $Sigla == 'BB'){
            $dados = array(
            2 => 'ENTRADA CONFIRMADA',
            3 => 'ENTRADA REJEITADA',
            4 => 'TRANSFERÊNCIA DE CARTEIRA/ENTRADA',
            5 => 'TRANSFERÊNCIA DE CARTEIRA/BAIXA',
            6 => 'LIQUIDAÇÃO',
            7 => 'CONFIRMAÇÃO DO RECEBIMENTO DA INSTRUÇÃO DE DESCONTO',
            8 => 'CONFIRMAÇÃO DO RECEBIMENTO DO CANCELAMENTO DO DESCONTO',
            9 => 'BAIXA',
            11 => 'TÍTULOS EM CARTEIRA (EM SER)',
            12 => 'CONFIRMAÇÃO RECEBIMENTO INSTRUÇÃO DE ABATIMENTO',
            13 => 'CONFIRMAÇÃO RECEBIMENTO INSTRUÇÃO DE CANCELAMENTO ABATIMENTO',
            14 => 'CONFIRMAÇÃO RECEBIMENTO INSTRUÇÃO ALTERAÇÃO DE VENCIMENTO',
            15 => 'FRANCO DE PAGAMENTO',
            17 => 'LIQUIDAÇÃO APÓS BAIXA OU LIQUIDAÇÃO TÍTULO NÃO REGISTRADO',
            19 => 'CONFIRMAÇÃO RECEBIMENTO INSTRUÇÃO DE PROTESTO',
            20 => 'CONFIRMAÇÃO RECEBIMENTO INSTRUÇÃO DE SUSTAÇÃO/CANCELAMENTO DE PROTESTO',
            23 => 'REMESSA A CARTÓRIO (APONTE EM CARTÓRIO)',
            24 => 'RETIRADA DE CARTÓRIO E MANUTENÇÃO EM CARTEIRA',
            25 => 'PROTESTADO E BAIXADO (BAIXA POR TER SIDO PROTESTADO)',
            26 => 'INSTRUÇÃO REJEITADA',
            27 => 'CONFIRMAÇÃO DO PEDIDO DE ALTERAÇÃO DE OUTROS DADOS',
            28 => 'DÉBITO DE TARIFAS/CUSTAS',
            29 => 'OCORRÊNCIAS DO SACADO',
            30 => 'ALTERAÇÃO DE DADOS REJEITADA',
            33 => 'CONFIRMAÇÃO DA ALTERAÇÃO DOS DADOS DO RATEIO DE CRÉDITO',
            34 => 'CONFIRMAÇÃO DO CANCELAMENTO DOS DADOS DO RATEIO DE CRÉDITO',
            35 => 'CONFIRMAÇÃO DO DESAGENDAMENTO DO DÉBITO AUTOMÁTICO',
            36 => 'CONFIRMAÇÃO DE ENVIO DE E-MAIL/SMS',
            37 => 'ENVIO DE E-MAIL/SMS REJEITADO',
            38 => 'CONFIRMAÇÃO DE ALTERAÇÃO DO PRAZO LIMITE DE RECEBIMENTO',
            39 => 'CONFIRMAÇÃO DE DISPENSA DE PRAZO LIMITE DE RECEBIMENTO',
            40 => 'CONFIRMAÇÃO DA ALTERAÇÃO DO NÚMERO DO TÍTULO DADO PELO CEDENTE',
            41 => 'CONFIRMAÇÃO DA ALTERAÇÃO DO NÚMERO CONTROLE DO PARTICIPANTE',
            42 => 'CONFIRMAÇÃO DA ALTERAÇÃO DOS DADOS DO SACADO',
            43 => 'CONFIRMAÇÃO DA ALTERAÇÃO DOS DADOS DO SACADOR/AVALISTA',
            44 => 'TÍTULO PAGO COM CHEQUE DEVOLVIDO',
            45 => 'TÍTULO PAGO COM CHEQUE COMPENSADO',
            46 => 'INSTRUÇÃO PARA CANCELAR PROTESTO CONFIRMADA',
            47 => 'INSTRUÇÃO PARA PROTESTO PARA FINS FALIMENTARES CONFIRMADA',
            48 => 'CONFIRMAÇÃO DE INSTRUÇÃO DE TRANSFERÊNCIA DE CARTEIRA/MODALIDADE DE COBRANÇA',
            49 => 'ALTERAÇÃO DE CONTRATO DE COBRANÇA',
            50 => 'TÍTULO PAGO COM CHEQUE PENDENTE DE LIQUIDAÇÃO'
            );
        }

        if($Tamanho == 400 && $Sigla == 'BB'){
            $dados = array(
                2 => 'ENTRADA CONFIRMADA',
                3 => 'ENTRADA REJEITADA',
                5 => 'LIQUIDAÇÃO SEM REGISTRO',
                6 => 'LIQUIDAÇÃO NORMAL',
                7 => 'LIQUIDAÇÃO POR CONTA',
                8 => 'LIQUIDAÇÃO POR SALDO',
                9 => 'BAIXA',
                10=> 'BAIXA SOLICITADA',
                11=> 'TITULOS EM SER',
                12=> 'ABATIMENTO CONCEDIDO',
                13=> 'ABATIMENTO CANCELADO',
                14=> 'ALTERAÇÃO VENCIMENTO',
                15=> 'LIQUIDAÇÃO EM CARTORIO',
                16=> 'ALTERAÇÃO JUROS',
                19=> 'CONF. DE RECEB. INSTRUC. PROTESTO',
                20=> 'DÉBITO EM CONTA',
                21=> 'ALTERAÇÃO NOME SACADO',
                22=> 'ALTERAÇÃO ENDEREÇO SACADO',
                23=> 'INDIC. ENCAMI. CARTORIO',
                24=> 'SUSTAR PROTESTO',
                25=> 'DISPENSAR JUROS',
                26=> 'ALTERAC. NUMERO DO TITULO',
                28=> 'MANUTENCAO TITULO VENCIDO',
                31=> 'CONCEDER DESCONTO',
                32=> 'NÃO CONCEDER DESCONTO',
                33=> 'RETIFICAR DESCONTO',
                34=> 'ALTERAR DATA DESCONTO',
                35=> 'COBRAR MULTA',
                36=> 'DISPENSAR MULTA',
                33=> 'COBRAR MULTA',
                37=> 'DISPENSAR INDEXADOR',
                38=> 'DISPENSAR PRAZO LIMITE PARA RECEB.',
                39=> 'ALTERAR PRAZO LIMITE PARA RECEB.',
                41=> 'ALTERAÇÃO DO NÚMERO DO CONTROLE DO PARTICIPANTE',
                42=> 'ALTERAÇÃO DO NÚMERO DO DOCUMENTO DO SACADO (CNPJ/CPF)',
                44=> 'TÍTULO PAGO COM CHEQUE DEVOLVIDO',
                46=> 'TÍTULO PAGO COM CHEQUE, AGUARDANDO COMPENSAÇÃO',
                72=> 'ALTERAÇÃO DE TIPO DE COBRANÇA',
                96=> 'DESPESAS DE PROTESTO',
                97=> 'DESPESAS DE SUSTAÇÃO DE PROTESTO',
                98=> 'DEBITO DE CUSTAS ANTECIPADAS');
        }

        $retorno = $dados[$valor];

        if($retorno){
            $retorno = ' ( '.$retorno.' )';
        }
        return $retorno;
    }


    public function getRetorno($NumRetorno = null, $Layout=null, $Filtro=null, $Ano=null,$idBanco = null, $SituacaoM = null){
        $criterio1 = '';
        $situacao = '';
        $ano = '';

        if($idBanco) $filtroBanco = "and ocorrencia_retorno.banco_id = '$idBanco'";
			

        //$this->DB->debug=1;
        if(!empty($Layout)){
            if($Layout == 'CAIXA ECONÔMICA SICOB - 240')  $banco =  " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('CS','CR', 'C'))";
            else if($Layout == 'CAIXA ECONÔMICA SIGCB - 240')  $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('SR'))";
            else if($Layout == 'BANCO REAL - 240/400')  $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('RS','RC')) ";
            else if($Layout == 'UNIBANCO - 400') $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('US')) ";
            else if($Layout == 'BANCO BRADESCO') $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('RU')) ";
            else if(($Layout == 'BANCO DO NORDESTE - 240') or ($Layout == 'BANCO DO NORDESTE - 400')) $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('BN'))";
            else if(($Layout == 'BANCO DO BRASIL - 240')or($Layout == 'BANCO DO BRASIL - 400')) $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('BB'))";
            else if($Layout == 'BANCO BRADESCO SEM REGISTRO - 400') $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('BR'))";
            else if($Layout == 'BANCO ITAU - 400') $banco = " and ocorrencia_retorno.banco_id in (SELECT id from bancos where sigla in ('IT'))";
            else if($Layout == 'BANCO SANTANDER - 240') $banco = " and ocorrencia_retorno.banco_id IN (SELECT id from bancos where sigla='BS')";
            else if($Layout == 'BANCO HSBC - 400')  $banco = " and ocorrencia_retorno.banco_id IN (SELECT id from bancos where sigla='HS')";
            else if($Layout == 'BIC - BANCO - 400') $banco = " and ocorrencia_retorno.banco_id IN (SELECT id from bancos where sigla='BI')";
            else $banco = " and ocorrencia_retorno.banco_id IN (SELECT id from bancos where sigla='-1')"; //valor nao existente

            $criterio1 = $banco;

            if (!empty($Filtro))
            {
                if ($Filtro == 1) $situacao = " and situacao in ('IGN','MAN','MEN') ";
                else if ($Filtro == 2) $situacao = " and situacao in ('MAI') ";
                else if ($Filtro == 3) $situacao = " and situacao in ('MEI') ";
                else if ($Filtro == 4) $situacao = " and situacao in ('NE') ";
                else if ($Filtro == 5) $situacao = " and situacao in ('IGNC','MANC','MENC','MAIC','MEIC') ";
                else if ($Filtro == 6) $situacao = " and situacao in ('IGNP','MANP','MENP','MAIP','MEIP') ";
                else if ($Filtro == 7) $situacao = " and situacao in ('IGNN','MANN','MENN','MAIN','MEIN') ";
            }
            if (!empty($Ano))
            {
                $ano =  " and year(data_ret) = '". $Ano . "' ";
            }
        }

        //carregando dados do layout
        $config_arq = fopen(DOMAIN_PATH."modulos/ocorrencia_retorno/config_layouts.txt","r");

        While(!feof($config_arq))
        {
            //linha atual do arquivo
            $linha_arq = fgets($config_arq);
            $linha_arq = explode("|",$linha_arq);

            //print_r($linha_arq1);exit();


            if ($Layout == trim($linha_arq[0]))
            {
                $ValorPadraoInicial_arq = trim($linha_arq[1]);
                $ValorPadraoInicial_arq = explode(",",$ValorPadraoInicial_arq);
                $ValorPadraoFinal_arq = trim($linha_arq[2]);
                $ValorPadraoFinal_arq = explode(",",$ValorPadraoFinal_arq);
                $NumRetorno_arq = trim($linha_arq[3]);
                $NumRetorno_arq = explode(",",$NumRetorno_arq);
                $diaDataGerRetorno_arq = trim($linha_arq[4]);
                $diaDataGerRetorno_arq = explode(",",$diaDataGerRetorno_arq);
                $mesDataGerRetorno_arq = trim($linha_arq[5]);
                $mesDataGerRetorno_arq = explode(",",$mesDataGerRetorno_arq);
                $anoDataGerRetorno_arq = trim($linha_arq[6]);
                $anoDataGerRetorno_arq = explode(",",$anoDataGerRetorno_arq);
                $LinhaT_arq = trim($linha_arq[7]);
                $LinhaT_arq = explode(",",$LinhaT_arq);
                $inicioNossoNumero24_arq = trim($linha_arq[8]);
                $inicioNossoNumero24_arq = explode(",",$inicioNossoNumero24_arq);
                $inicioNossoNumero90_arq = trim($linha_arq[9]);
                $inicioNossoNumero90_arq = explode(",",$inicioNossoNumero90_arq);
                $inicioNossoNumero024_arq = trim($linha_arq[10]);
                $inicioNossoNumero024_arq = explode(",",$inicioNossoNumero024_arq);
                $NossoNumero24_arq = trim($linha_arq[11]);
                $NossoNumero24_arq = explode(",",$NossoNumero24_arq);
                $NossoNumero90_arq = trim($linha_arq[12]);
                $NossoNumero90_arq = explode(",",$NossoNumero90_arq);
                $idcontasareceberT_arq = trim($linha_arq[13]);
                $idcontasareceberT_arq = explode(",",$idcontasareceberT_arq);
                $descricao_arq = trim($linha_arq[14]);
                $descricao_arq = explode(",",$descricao_arq);
                $LinhaU_arq = trim($linha_arq[15]);
                $LinhaU_arq = explode(",",$LinhaU_arq);
                $Valor_arq = trim($linha_arq[16]);
                $Valor_arq = explode(",",$Valor_arq);
                $diaDataOcorrencia_arq = trim($linha_arq[17]);
                $diaDataOcorrencia_arq = explode(",",$diaDataOcorrencia_arq);
                $mesDataOcorrencia_arq = trim($linha_arq[18]);
                $mesDataOcorrencia_arq = explode(",",$mesDataOcorrencia_arq);
                $anoDataOcorrencia_arq = trim($linha_arq[19]);
                $anoDataOcorrencia_arq = explode(",",$anoDataOcorrencia_arq);
                $diaDataCredito_arq = trim($linha_arq[20]);
                $diaDataCredito_arq = explode(",",$diaDataCredito_arq);
                $mesDataCredito_arq = trim($linha_arq[21]);
                $mesDataCredito_arq = explode(",",$mesDataCredito_arq);
                $anoDataCredito_arq = trim($linha_arq[22]);
                $anoDataCredito_arq = explode(",",$anoDataCredito_arq);
                $idcontasareceberU_arq = trim($linha_arq[23]);
                $idcontasareceberU_arq = explode(",",$idcontasareceberU_arq);
                $digitoNossoNumero_arq = trim($linha_arq[24]);
                $digitoNossoNumero_arq = explode(",",$digitoNossoNumero_arq);

                $CS_arq = trim($linha_arq[25]);
                $CS_arq = explode(",",$CS_arq);


            }

        }

        fclose($config_arq);

        $camposM = '';
        if(!$SituacaoM) $criterio1 = " where num_retorno = '".$NumRetorno."'".$criterio1;
        else{

            $NossoNumeroRetorno = "RTRIM(LTRIM(SUBSTRING(ocorrencia_retorno.descricao,".($NossoNumero24_arq[0]+1).",".$NossoNumero24_arq[1].")))";
            $NossoNumeroBanco = "m.nosso_numero";

             if($Layout == 'BANCO SANTANDER - 400')
                 $NossoNumeroBanco = "rtrim(ltrim(substring(m.nosso_numero,6,LENGTH(m.nosso_numero)-1)))";
             elseif($Layout == 'BANCO DO BRASIL - 400'){
                 $NossoNumeroBanco = "substring(m.nosso_numero,1,".($NossoNumero24_arq[1]-1).")";
				 $criterio1 .= " and substring(ocorrencia_retorno.descricao,".($CS_arq[0]+1).",".$CS_arq[1].") in ('05','06','07','08','15')";
			 }elseif($Layout == 'BANCO BRADESCO SEM REGISTRO - 400')
                 $NossoNumeroBanco = "substring(m.nosso_numero,3,LENGTH(m.nosso_numero))";
             elseif($Layout == 'BANCO DO BRASIL - 240'){
                $NossoNumeroBanco = "substring(m.nosso_numero,1,".$NossoNumero24_arq[1].")";
				$criterio1 .= " and substring(ocorrencia_retorno.descricao,".($CS_arq[0]+1).",".$CS_arq[1].") in ('06','17')";
			}
             elseif(substr($Layout,0,17) == 'BANCO DO NORDESTE')
                 $NossoNumeroRetorno = "SUBSTRING(RTRIM(LTRIM(SUBSTRING(ocorrencia_retorno.descricao,38,20))),1,LENGTH(RTRIM(LTRIM(SUBSTRING(ocorrencia_retorno.descricao,38,20))))-1)";
             elseif($Layout == 'PAG CONTAS - 240')
                 $NossoNumeroRetorno = "RTRIM(LTRIM(SUBSTRING(o.descricao, 71,11)))+'PC'";

            $camposM = ' ,m.valor as Valor,m.data_vencimento as DtVencimento';
            $criterio1 = ", parcelas m where ".$NossoNumeroRetorno.'='.$NossoNumeroBanco." and m.situacao_pagamento_id in ('".implode("','",$SituacaoM)."') ".$criterio1;
        }

      $sql="select ocorrencia_retorno.*, ocorrencia_retorno.descricao as Descricao, ocorrencia_retorno.descricao1 as Descricao1, num_retorno as NumRetorno,data_ret as DataRet, boleto_baixado as BoletoBaixado,
            (case
            when situacao in ('IGN','MAN','MEN') then	'NORMAL'
            when situacao in  ('MAI') then 'PAGO A MAIOR INCONSISTENTE'
            when situacao in  ('MEI') then 'PAGO A MENOR INCONSISTENTE'
            when situacao in ('NE') then 'NÃO ENCONTRADOS OU EXCLUÍDOS'
            when situacao in ('IGNC','MANC','MENC','MAIC','MEIC') then 'CANCELADOS'
            when situacao in ('IGNP','MANP','MENP','MAIP','MEIP') then 'JÁ PAGOS'
            when situacao in ('IGNN','MANN','MENN','MAIN','MEIN') then 'NEGOCIADOS'
            END) AS Situacao,
               data_ret as DtPagamento, ocorrencia_retorno.valor_esperado as ValorEsperado, (select sigla from bancos where id=ocorrencia_retorno.banco_id) as Sigla,
               (select descricao from ocorrencia_retorno oc2 where oc2.id = (ocorrencia_retorno.id+1)) as proximaLinha,
               (select valor_esperado from ocorrencia_retorno oc2 where oc2.id = (ocorrencia_retorno.id+1)) as ValorEsperadoProximaLinha
                $camposM from ocorrencia_retorno ".$criterio1.$situacao.$ano." $filtroBanco
                ORDER BY situacao,num_retorno, ocorrencia_retorno.id";

        $rs=$this->DB->Execute($sql);

        while(!$rs->EOF)
        {
			$rs->fields['Sigla'] = trim($rs->fields['Sigla']);
            $dados_mensalidades = array('DtVencimento' => formata_data($rs->fields['DtVencimento']),'Valor' => $rs->fields['Valor']);

            $tamaho1 = explode(' - ',$Layout);
            $Tamanho = $tamaho1[(count($tamaho1) - 1)];

            $campo_cs = ($CS_arq[0] < 240) ? 'Descricao' : 'Descricao1';
            $CS = substr($rs->fields[$campo_cs],$CS_arq[0],$CS_arq[1]);//Código de ocorrência

            $ValorEsperado = trim($rs->fields['ValorEsperado']);

            $rs->fields['Sigla'] = trim($rs->fields['Sigla']);

            $situacao_retorno = $this->situacaoRetorno((int)$CS, $Tamanho, $rs->fields['Sigla']);

            //if //CAIXA ECONÔMICA SIGCB - 240
            if($Tamanho == '240'){

                $idcontasareceber = substr($rs->fields['Descricao'],$idcontasareceberU_arq[0],$idcontasareceberU_arq[1]);//NossoNumero  sem o digito verificador
                $idcontasareceber = (int)$idcontasareceber;
                if($Layout == 'CAIXA ECONÔMICA SIGCB - 240'){
                    if((substr($rs->fields['Descricao'],$inicioNossoNumero24_arq[0],$inicioNossoNumero24_arq[1]) == '24')or(substr($rs->fields['Descricao'],$inicioNossoNumero024_arq[0],$inicioNossoNumero024_arq[2]) == '024'))
                        $NossoNumero = substr($rs->fields['Descricao'],$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                    if((substr($rs->fields['Descricao'],$inicioNossoNumero90_arq[0],$inicioNossoNumero90_arq[1]) == '90'))
                        $NossoNumero = substr($rs->fields['Descricao'],$NossoNumero90_arq[0],$NossoNumero90_arq[1]); //NossoNumero  sem o digito verificador

                }
                else{

                    //outros 240
                    if(($rs->fields['Sigla'] == 'CS' or $rs->fields['Sigla']=='CR') and $Tamanho == '240') //CAIXA ECONÔMICA SICOB - 240
                    {
                        $NossoNumero = substr($rs->fields['Descricao'],$inicioNossoNumero24_arq[0],$inicioNossoNumero24_arq[1]); //NossoNumero  sem o digito verificador
                        $NossoNumero = $NossoNumero . CalculaDV11NN($NossoNumero); //NossoNumero  sem o digito verificador
                    }
                    else if ($rs->fields['Sigla'] == 'BB' and $Tamanho == '240') // BANCO DO BRASIL - 240
                    {

                        $NossoNumero = substr($rs->fields['Descricao'],$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                        if ((strlen(trim($NossoNumero)) == strlen(RemoveChar(trim($NossoNumero)))) and (substr(trim($NossoNumero),0,1) != '8'))
                            $NossoNumero = trim($NossoNumero) . CalculaDV11NN(trim($NossoNumero));

                    }
                    else if ((($rs->fields['Sigla'] == 'RS' or $rs->fields['Sigla'] == 'RC') and $Tamanho == '240') // BANCO REAL - 240
                        or ($rs->fields['Sigla'] == 'BS' and $Tamanho == '240')) //BANCO SANTANDER - 240
                    {
                        $NossoNumero = substr($rs->fields['Descricao'],$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                    }
                    else if ($rs->fields['Sigla'] == 'BN' and $Tamanho == '240') //BANCO DO NORDESTE - 240
                    {

                        $NossoNumero = str_replace(' ', '', substr($rs->fields['Descricao'],37,20)); //NossoNumero
                        $countNN     = strlen($NossoNumero);
                        $NossoNumero = substr($NossoNumero,0,$countNN-1);
                        $countNN     = strlen($NossoNumero);
                        $i = 1;
                        While ($i <= (7-$countNN))
                        {
                            $NossoNumero = '0' . $NossoNumero;
                            $i++;
                        }



                    }

                }

                if($Layout == 'BANCO DO NORDESTE - 240'){

                    if(!$SituacaoM){
                        $DataOcorrencia = substr($rs->fields['Descricao'],$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($rs->fields['Descricao'],$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/' . substr($rs->fields['Descricao'],$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);
                        $Valor = ((float)substr($rs->fields['Descricao'],$Valor_arq[0],$Valor_arq[1]))/100;
                    }
                    else
                    {
                        $DataOcorrencia = substr($rs->fields['proximaLinha'],$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($rs->fields['proximaLinha'],$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/' . substr($rs->fields['proximaLinha'],$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);
                        $Valor = ((float)substr($rs->fields['proximaLinha'],$Valor_arq[0],$Valor_arq[1]))/100;
                        $ValorEsperado = trim($rs->fields['ValorEsperadoProximaLinha']);

                    }

                }
                else
                {
                    if(!$SituacaoM){
                        $DataOcorrencia = substr($rs->fields['Descricao'],$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($rs->fields['Descricao'],$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/' . substr($rs->fields['Descricao'],$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);
                        $Valor = ((float)substr($rs->fields['Descricao'],$Valor_arq[0],$Valor_arq[1]))/100;
                    }
                    else
                    {
                        $DataOcorrencia = substr($rs->fields['proximaLinha'],$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($rs->fields['proximaLinha'],$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/' . substr($rs->fields['proximaLinha'],$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);
                        $Valor = ((float)substr($rs->fields['proximaLinha'],$Valor_arq[0],$Valor_arq[1]))/100;
                        $ValorEsperado = trim($rs->fields['ValorEsperadoProximaLinha']);

                    }

                }

            }
            else
            {

                if($diaDataOcorrencia_arq[0] > 240){

                    $diaDataOcorrencia_arq[0] = $diaDataOcorrencia_arq[0] - 240;
                    $mesDataOcorrencia_arq[0] = $mesDataOcorrencia_arq[0] - 240;
                    $anoDataOcorrencia_arq[0] = $anoDataOcorrencia_arq[0] - 240;
                    $linha = $rs->fields['Descricao1'];

                }
                else
                    $linha = $rs->fields['Descricao'];

                $DataOcorrencia = substr($linha,$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($linha,$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/20' . substr($linha,$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);

                if($Valor_arq[0] > 240){

                    $Valor_aux = $Valor_arq[0] - 240;
                    $linha = $rs->fields['Descricao1'];

                }
                else{
                    $Valor_aux = $Valor_arq[0];
                    $linha = $rs->fields['Descricao'];
                }

                $Valor = ((float)substr($linha,$Valor_aux,$Valor_arq[1]))/100;
                $Taxa = (float)(substr($linha,175,13))/100;

                if ((trim($rs->fields['Sigla']) == 'BN' and $Tamanho == '400') //BANCO DO NORDESTE - 400
                    or (trim($rs->fields['Sigla']) == 'IT' and $Tamanho == '400')) //BANCO ITAU - 400
                    $Valor = $Valor + $Taxa;


                if($NossoNumero24_arq[0] > 240){

                    $NossoNumero24_arq[0] = $NossoNumero24_arq[0] - 240;
                    $idcontasareceberU_arq[0] = $idcontasareceberU_arq[0] - 240;
                    $linha = $rs->fields['Descricao1'];

                }
                else
                    $linha = $rs->fields['Descricao'];

                //layout 400
                $NossoNumero = substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                $idcontasareceber = substr($linha,$idcontasareceberU_arq[0],$idcontasareceberU_arq[1]);//NossoNumero  sem o digito verificador

                //BANCO BRADESCO SEM REGISTRO - 400
                if($Layout == 'BANCO BRADESCO SEM REGISTRO - 400'){
                    $NossoNumeroSemDigito = substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]-1);//NossoNumero  sem o digito verificador
                    $Digito = substr($linha,$digitoNossoNumero_arq[0],$digitoNossoNumero_arq[1]);
                    if($Digito == CalculaDV11BR('06'.$NossoNumeroSemDigito)){
                        $NossoNumero = '06'.substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador
                    }else if($Digito == CalculaDV11BR('09'.$NossoNumeroSemDigito)){
                        $NossoNumero = '09'.substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador
                    }

                }
                else{

                    //verifica os bancos que não tem digito
                    if($Layout!='BIC - BANCO - 400'
                            and $Layout!='BANCO ITAU - 400'
                            and $Layout!='BANCO BRADESCO SEM REGISTRO - 400'
                            and $Layout!='BANCO SANTANDER - 400'){

                        //outros
                        if ((strlen(trim($NossoNumero)) == strlen(RemoveChar(trim($NossoNumero)))) and (substr(trim($NossoNumero),0,1) != '8') and trim($rs->fields['Sigla']) !='BN' and trim($rs->fields['Sigla']) !='HS')
                            $NossoNumero = trim($NossoNumero) . CalculaDV11NN(trim($NossoNumero));
                        else
                            $NossoNumero = trim($NossoNumero);
                    }

                }

            }

            if($Layout == 'BANCO BRADESCO SEM REGISTRO - 400' and $idBanco and CodCarteira($idBanco) != substr($NossoNumero,0,2))
                $filtro_nosso_numero = " substring(nosso_numero,3,LENGTH(nosso_numero)) = '".$NossoNumero."'";
            elseif($Layout == 'BIC - BANCO - 400'){
                $filtro_nosso_numero = " substring(nosso_numero,8,6) = '".$NossoNumero."'";
            /*elseif($Layout == 'BANCO HSBC - 400'){ //tratamento para mensalidades migradas da florence

                $filtro_nosso_numero = " nossonumero = '".(int) substr($NossoNumero,5,5)."' and idBanco in ( select id from bancos where sigla in ('HS'))";
            */}elseif($Layout == 'CAIXA ECONÔMICA SIGCB - 240' and substr($NossoNumero,0,2) == '90') //tratamento para mensalidades migradas da florence
                $filtro_nosso_numero = " LPAD('0',(18 - LENGTH(nosso_numero)),'0')+ nosso_numero like '%".substr($NossoNumero,2)."%' and banco_id in ( select id from bancos where sigla in ('SR','C'))";
            else
                $filtro_nosso_numero = " nosso_numero = '".$NossoNumero."'";

            if(!$SituacaoM) $dados_mensalidades = $this->DB->Execute(" select valor as Valor,data_vencimento as DtVencimento from parcelas where $filtro_nosso_numero")->fields;
			
			if(!$dados_mensalidades['DtVencimento']){
					if($Layout == 'BANCO HSBC - 400'){ //tratamento para mensalidades migradas da florence
						$filtro_nosso_numero = " nosso_numero = '".(int) substr($NossoNumero,5,5)."' and banco_id in ( select id from bancos where sigla in ('HS'))";
						$dados_mensalidades = $this->DB->Execute(" select valor as Valor,data_vencimento as DtVencimento from parcelas where $filtro_nosso_numero")->fields;
			
					}
			}

            if($dados_mensalidades['DtVencimento']){
                $idcontasareceber = '';
            }

            $retorno[]=array(
                "NumRetorno"=>trim($rs->fields['NumRetorno']),
                "Situacao"=>trim($rs->fields['Situacao']).$situacao_retorno,
                "NossoNumero"=> $NossoNumero,
                "BoletoBaixado"=>trim($rs->fields['BoletoBaixado']),
                "DtVencimento"=>trim(formata_data($dados_mensalidades['DtVencimento'])),
                "DtPagamento"=>trim($DataOcorrencia),
                "ValorEsperado"=> $ValorEsperado,
                "ValorTitulo"=>trim($dados_mensalidades['Valor']),
                "ValorPago"=>trim($Valor),
                "DataRet"=>trim(formata_data($rs->fields['DataRet'])),
                "CS"=>trim($CS),
                "idContaMigrada"=> $idcontasareceber
            );
            $rs->MoveNext();
        }

        return $retorno;
    }

    public function getRelatorio($NossoNumero, $idContaMigrada = null, $Layout = null){

        //$this->DB->debug=1;

        $filtro = " m.nosso_numero = '" . $NossoNumero . "' ";

        if($Layout == 'BANCO SANTANDER - 400')
            $filtro = " substring(m.nosso_numero,6,8) = '" . $NossoNumero . "' ";
        elseif($Layout == 'BIC - BANCO - 400')
            $filtro = " substring(m.nosso_numero,8,6) = '" . $NossoNumero . "' ";
        elseif($Layout == 'BANCO BRADESCO SEM REGISTRO - 400'){

            $codCarteira = $this->DB->execute("select carteira as Carteira from bancos where sigla = 'BR'")->fields['Carteira'];

            if(!empty($codCarteira) and substr($NossoNumero,0,2) != $codCarteira)
                $filtro = " substring(m.nosso_numero,3,LENGTH(m.nosso_numero)) = '". $NossoNumero . "' ";
        /*}elseif($Layout == 'BANCO HSBC - 400'){ //tratamento para mensalidades migradas da florence

            $filtro = " nossonumero = '".(int) substr($NossoNumero,5,5)."' and m.idBanco in ( select id from bancos where sigla in ('HS'))";
        */}elseif($Layout == 'CAIXA ECONÔMICA SIGCB - 240' and substr($NossoNumero,0,2) == '90') //tratamento para mensalidades migradas da florence
            $filtro = " LPAD('0',(18 - LENGTH(nosso_numero)),'0')+ nosso_numero like '%".substr($NossoNumero,2)."%' and m.banco_id in ( select id from bancos where sigla in ('SR','C'))";


        $sql="select m.seu_numero as SeuNumero,m.id as Matricula,
            c.nome as Nome, sequencial as Seq, 
            sm.descricao as SituacaoBol  from parcelas m
           inner join movimentacao mo on mo.id = m.movimentacao_id
        inner join cliente c on c.id = mo.cliente_id
            inner join situacao_pagamento sm on m.situacao_pagamento_id=sm.id where ";

        $rs=$this->DB->Execute($sql.$filtro);
		if($rs->recordCount() == 0){
				if($Layout == 'BANCO HSBC - 400'){ //tratamento para mensalidades migradas da florence
					$filtro = " nosso_numero = '".(int) substr($NossoNumero,5,5)."' and m.banco_id in ( select id from bancos where sigla in ('HS'))";
					
					$rs=$this->DB->Execute($sql.$filtro);
				}
		}
        while(!$rs->EOF)
        {
            $dados[]=array(
                "SeuNumero"=>trim($rs->fields['SeuNumero']),
                "Matricula"=>trim($rs->fields['Matricula']),
                "Seq"=>trim($rs->fields['Seq']),
                "Neg"=>trim($rs->fields['Neg']),
                "SituacaoBol"=>trim($rs->fields['SituacaoBol']),
                "Nome"=>trim($rs->fields['Nome'])
            );
            $rs->MoveNext();
        }

        return $dados;
    }
}
$relatorio = new Relatorio();
?>