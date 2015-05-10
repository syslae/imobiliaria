<?php
session_start();
require("../../config/define.php");
require(DOMAIN_PATH."config/conexaoAr.php");
require(DOMAIN_PATH."funcoes.inc.php");
require(DOMAIN_PATH."funcoesFinanceiro.inc.php");
require(DOMAIN_PATH."funcoesValidar.inc.php");
header("Content-type: text/html; charset=ISO-8859-1");
verifica ("../../login.php");

#$DB->debug = true;

include(DOMAIN_PATH."core/model/ocorrencia_retorno.Model.php");

class Baixa extends ADOdb_Active_Record
{
    var $_table = 'baixa';
}

class Parcelas extends ADOdb_Active_Record
{
    var $_table = 'parcelas';
}

function paraExecucao($e){

    echo " <div class='notification msgalert'>
            <p>Entre em contato com o analista responsavel e envie a imagem desta mensagem.<br/>".$e->getMessage()."</p>
        </div>";
    die;
}

//servi para verificar se o arquivo selecionado pertence a conta informada
function validaArquivo($Sigla, $idBanco, $linha, $PosicoesLinha){

    global $DB, $de, $arquivos_nao_sao_da_conta;

    $Conta = '';
    $ContaRetorno = '';

    $Conta = $DB->Execute("select REPLACE(REPLACE(REPLACE(agencia_cod_cedente,'/',''),'-',''),' ','') as AgenciaCodCedente,
         SUBSTRING(agencia_cod_cedente,1,4)+''+SUBSTRING(agencia_cod_cedente,9,7)+''+SUBSTRING(agencia_cod_cedente,13,1) as AgenciaCodCedente2,
 SUBSTRING(agencia_cod_cedente,8,7) as ContaBS
         ,ltrim(rtrim(agencia))+''+ltrim(rtrim(conta)) as ContaBS240,ltrim(tipo_conta)+''+ltrim(conta)+''+ltrim(digito_conta) as ContaBIC
         from bancos where sigla='".$Sigla."' and id='".$idBanco."'");

    if(($Sigla=='BS')and($PosicoesLinha=='400')){
        $Conta = $Conta->fields['ContaBS'];

    }elseif(($Sigla=='BS')and($PosicoesLinha=='240')){
        $Conta = $Conta->fields['ContaBS240'];

    }
    elseif(($Sigla=='BI')and($PosicoesLinha=='400')){
        $Conta = $Conta->fields['ContaBIC'];

    }elseif($Sigla=='BR'){
        //mudanca ajuste erro para famep
        //$Conta = $Conta->fields['AgenciaCodCedente2'];

        $CTA_DEB = $DB->Execute("select REPLACE(REPLACE(REPLACE(SUBSTRING(agencia_cod_cedente,1,4)+''+cta_deb,'/',''),'-',''),' ','') +''+digito_cta_deb as AgenciaCodCedente
        from bancos where sigla='".$Sigla."' and id='".$idBanco."'")->fields['AgenciaCodCedente'];

        $Conta = substr($Conta->fields['AgenciaCodCedente'],0,4).substr($Conta->fields['AgenciaCodCedente'],5);
    }else{
        $Conta = $Conta->fields['AgenciaCodCedente'];
    }

    // BANCO DO BRASIL ? 240
    if(($Sigla=='BB')and($PosicoesLinha=='240')) $ContaRetorno = substr($linha,52,19);
    //BANCO DO BRASIL ? 400
    else if(($Sigla=='BB')and($PosicoesLinha=='400'))  $ContaRetorno = substr($linha,26,5).'00000'.substr($linha,32,8);
    //BANCO ITAU - 400
    else if(($Sigla=='IT')and($PosicoesLinha=='400'))  $ContaRetorno = substr($linha,26,4).''.substr($linha,32,6);
    //BANCO DO NORDESTE - 400
    else if(($Sigla=='BN')and($PosicoesLinha=='400'))  $ContaRetorno = substr($linha,26,4).''.substr($linha,32,8);
    //BANCO HSBC - 400
    else if(($Sigla=='HS')and($PosicoesLinha=='400'))  $ContaRetorno = substr($linha,26,5).''.substr($linha,37,7);
    //BANCO BRADESCO SEM REGISTRO - 400
    else if(($Sigla=='BR')and($PosicoesLinha=='400'))  $ContaRetorno = substr($linha,25,4).''.substr($linha,29,8);
    //CAIXA ECONÔMICA SEM REGISTRO - 240
    else if(($Sigla=='SR')and($PosicoesLinha=='240'))  $ContaRetorno = substr($linha,52,5).''.substr($linha,58,6);
    //BANCO HSBC - 240
    else if(($Sigla=='HS')and($PosicoesLinha=='240'))  $ContaRetorno = substr($linha,52,5).''.substr($linha,58,12);
    //BANCO DO NORDESTE  - 240
    else if(($Sigla == 'BN')and($PosicoesLinha=='240'))  $ContaRetorno = substr($linha,52,5).''.substr($linha,63,8);
    //BANCO SANTANDER - 240
    else if(($Sigla=='BS')and($PosicoesLinha=='240'))  $ContaRetorno = substr($linha,32,4).''.substr($linha,37,9);
    //BANCO SANTANDER - 400
    else if(($Sigla=='BS')and($PosicoesLinha=='400'))  $ContaRetorno = substr($linha,110,7);
    //BIC - BANCO
    else if(($Sigla=='BI'))  $ContaRetorno = substr($linha,26,10);

    $Conta = Completa($Conta,'NI',30);
    //echo $ContaRetorno; exit();
    $ContaRetorno = Completa($ContaRetorno,'NI',30);

    if($Conta != $ContaRetorno)
    {
        //mudanca ajuste erro para famep

        if(($Sigla=='BR') and Completa($CTA_DEB,'NI',30) == $ContaRetorno){
            return true;
        }
        else
        {
            $arquivos_nao_sao_da_conta[] = "O arquivo ".$de." n�o foi tratado!\n A Conta selecionada � diferente do arquivo.\nConta selecionada: ".$Conta."\nConta do arquivo : ".$ContaRetorno."\n\n ";
            //$arquivos_nao_sao_da_conta[] = "Atenção para o arquivo ".$de."!\n A Conta selecionada é diferente do arquivo.\nConta selecionada: ".$Conta."\nConta do arquivo : ".$ContaRetorno."\n\n ";
            return false;
        }
    }

    return true;
}

if(empty($_POST['cont'])){

    //vindo pela primeira vez, direto do form do cadastrar.php
    $cont = 0;
    $cont_arq = 1;

    $ds = $DB->Execute("Select sigla as Sigla, tamanho_linha as TamanhoLinha,
            '' as idCaixa from bancos where id = '".$Layout."'");

    $Sigla = trim($ds->fields['Sigla']);
    $Tamanho = trim($ds->fields['TamanhoLinha']);

    if(empty($Layout))
    {
        echo('Informe o Layout!');
        $erro .= 'Arquivo';

    }
    else if(empty($Margem))
    {
        echo('Informe a Margem!');
        $erro .= 'Margem';

    }
    else if($ds->RecordCount() == 0)
    {
        echo('Banco inv�lido.');
        $erro .= 'idCaixa';

    }
    else if(empty($Sigla))
    {
        echo('Informe a Sigla do Banco no cadastro de Documento de Cobran�a.');
        $erro .= 'Sigla';

    }
    else if(empty($Tamanho))
    {
        echo('Informe o Tamanho no cadastro de Documento de Cobran�a.');
        $erro .= 'Tamanho';

    }

    $SituacaoPago = $DB->Execute("Select id as id_Situacao_Pagamento from situacao_pagamento where descricao = 'PAGO'");
    $SituacaoPago = $SituacaoPago->fields['id_Situacao_Pagamento'];

    $i = 1;

    //carregando dados do layout
    $config_arq = fopen(DOMAIN_PATH."modulos/ocorrencia_retorno/config_layouts.txt","r");

    switch($Sigla){
        case 'BB':
            $DescLayout = "BANCO DO BRASIL - ".$Tamanho;
            break;
        case 'CS':
        case 'CR':
            $DescLayout = "CAIXA ECONÔMICA SICOB - ".$Tamanho;
            break;
        case 'SR':
            $DescLayout = "CAIXA ECONÔMICA SIGCB - ".$Tamanho;
            break;
        case 'RS':
        case 'RC':
            $DescLayout = "BANCO REAL - ".$Tamanho;
            break;
        case 'BN':
            $DescLayout = "BANCO DO NORDESTE - ".$Tamanho;
            break;
        case 'BS':
            $DescLayout = "BANCO SANTANDER - ".$Tamanho;
            break;
        case 'BR':
            $DescLayout = "BANCO BRADESCO SEM REGISTRO - ".$Tamanho;
            break;
        case 'IT':
            $DescLayout = "BANCO ITAU - ".$Tamanho;
            break;
        case 'HS':
            $DescLayout = "BANCO HSBC - ".$Tamanho;
            break;
        case 'BI':
            $DescLayout = "BIC - BANCO - ".$Tamanho;
            break;

    }

    if(!empty($DescLayout)) $_SESSION['DescLayout'] = $DescLayout;
    if(!empty($_SESSION['DescLayout'])) $DescLayout = $_SESSION['DescLayout'];

    While(!feof($config_arq))
    {
        //linha atual do arquivo
        $linha_arq = fgets($config_arq);
        $linha_arq = explode("|",$linha_arq);

        //print_r($linha_arq1);exit();

        if ($DescLayout == trim($linha_arq[0]) and !empty($DescLayout))
        {

            $ValorPadraoInicial_arq = trim($linha_arq[1]);
            $_SESSION['ValorPadraoInicial_arq_'.$sistema] = $ValorPadraoInicial_arq = explode(",",$ValorPadraoInicial_arq);

            $ValorPadraoFinal_arq = trim($linha_arq[2]);
            $_SESSION['ValorPadraoFinal_arq_'.$sistema] = $ValorPadraoFinal_arq = explode(",",$ValorPadraoFinal_arq);

            $NumRetorno_arq = trim($linha_arq[3]);
            $_SESSION['NumRetorno_arq_'.$sistema] = $NumRetorno_arq = explode(",",$NumRetorno_arq);

            $diaDataGerRetorno_arq = trim($linha_arq[4]);
            $_SESSION['diaDataGerRetorno_arq_'.$sistema] = $diaDataGerRetorno_arq = explode(",",$diaDataGerRetorno_arq);

            $mesDataGerRetorno_arq = trim($linha_arq[5]);
            $_SESSION['mesDataGerRetorno_arq_'.$sistema] = $mesDataGerRetorno_arq = explode(",",$mesDataGerRetorno_arq);

            $anoDataGerRetorno_arq = trim($linha_arq[6]);
            $_SESSION['anoDataGerRetorno_arq_'.$sistema] = $anoDataGerRetorno_arq = explode(",",$anoDataGerRetorno_arq);

            $LinhaT_arq = trim($linha_arq[7]);
            $_SESSION['LinhaT_arq_'.$sistema] = $LinhaT_arq = explode(",",$LinhaT_arq);

            $inicioNossoNumero24_arq = trim($linha_arq[8]);
            $_SESSION['inicioNossoNumero24_arq_'.$sistema] = $inicioNossoNumero24_arq = explode(",",$inicioNossoNumero24_arq);

            $inicioNossoNumero90_arq = trim($linha_arq[9]);
            $_SESSION['inicioNossoNumero90_arq_'.$sistema] = $inicioNossoNumero90_arq = explode(",",$inicioNossoNumero90_arq);

            $inicioNossoNumero024_arq = trim($linha_arq[10]);
            $_SESSION['inicioNossoNumero024_arq_'.$sistema] = $inicioNossoNumero024_arq = explode(",",$inicioNossoNumero024_arq);

            $NossoNumero24_arq = trim($linha_arq[11]);
            $_SESSION['NossoNumero24_arq_'.$sistema] = $NossoNumero24_arq = explode(",",$NossoNumero24_arq);

            $NossoNumero90_arq = trim($linha_arq[12]);
            $_SESSION['NossoNumero90_arq_'.$sistema] = $NossoNumero90_arq = explode(",",$NossoNumero90_arq);

            $idcontasareceberT_arq = trim($linha_arq[13]);
            $_SESSION['idcontasareceberT_arq_'.$sistema] = $idcontasareceberT_arq = explode(",",$idcontasareceberT_arq);

            $descricao_arq = trim($linha_arq[14]);
            $_SESSION['descricao_arq_'.$sistema] = $descricao_arq = explode(",",$descricao_arq);

            $LinhaU_arq = trim($linha_arq[15]);
            $_SESSION['LinhaU_arq_'.$sistema] = $LinhaU_arq = explode(",",$LinhaU_arq);

            $Valor_arq = trim($linha_arq[16]);
            $_SESSION['Valor_arq_'.$sistema] = $Valor_arq = explode(",",$Valor_arq);

            $diaDataOcorrencia_arq = trim($linha_arq[17]);
            $_SESSION['diaDataOcorrencia_arq_'.$sistema] = $diaDataOcorrencia_arq = explode(",",$diaDataOcorrencia_arq);

            $mesDataOcorrencia_arq = trim($linha_arq[18]);
            $_SESSION['mesDataOcorrencia_arq_'.$sistema] = $mesDataOcorrencia_arq = explode(",",$mesDataOcorrencia_arq);

            $anoDataOcorrencia_arq = trim($linha_arq[19]);
            $_SESSION['anoDataOcorrencia_arq_'.$sistema] = $anoDataOcorrencia_arq = explode(",",$anoDataOcorrencia_arq);

            $diaDataCredito_arq = trim($linha_arq[20]);
            $_SESSION['diaDataCredito_arq_'.$sistema] = $diaDataCredito_arq = explode(",",$diaDataCredito_arq);

            $mesDataCredito_arq = trim($linha_arq[21]);
            $_SESSION['mesDataCredito_arq_'.$sistema] = $mesDataCredito_arq = explode(",",$mesDataCredito_arq);

            $anoDataCredito_arq = trim($linha_arq[22]);
            $_SESSION['anoDataCredito_arq_'.$sistema] = $anoDataCredito_arq = explode(",",$anoDataCredito_arq);

            $idcontasareceberU_arq = trim($linha_arq[23]);
            $_SESSION['idcontasareceberU_arq_'.$sistema] = $idcontasareceberU_arq = explode(",",$idcontasareceberU_arq);
        }

    }

    fclose($config_arq);

    if ($Sigla == 'BI')
    {
        $sql = "select id as idBanco, radical as Radical, matricula_banco as MatriculaBanco, agencia as Agencia 
                from bancos where id='".$Layout."'";

        $rs = $DB->Execute($sql);

        $Radical = $rs->fields['Radical'];
        $MatriculaBanco = $rs->fields['MatriculaBanco'];
        $Agencia = $rs->fields['Agencia'];
    }


}

$Condicao = "";
//$DB->debug = true;
if (empty($erro))
{

    $arquivos_nao_sao_da_conta = array();
    $nome_arquivo = array();
    $indice = 0;

    try{

        while ($i <= $_POST['qtde_arq'])
        {
            //recebendo o nome do arquivo do upload do arquivo
            $arq = $de = $_POST["nome_arquivo".$i.""];

            // Caminho de onde ficará a arquivo
            $caminho = DOMAIN_PATH."modulos/ocorrencia_retorno/arquivos/" . $arq;

            // abre o arquivo
            if (file_exists($caminho))
            {

                $Condicao = "";
                $qtd_linhas = count(file($caminho));

                if($tipoRetorno == 'html') include(DOMAIN_PATH."modulos/ocorrencia_retorno/barra_progresso.php");
                $RetornoExistente = 'F';
                $RetornoExistenteAntes = 'F';
                // Enquanto não for o fim do arquivo, executa o laço...

                //bradesco os dados da conta estão na segunda linha então pega antes de entrar no loop
                if($Sigla=='BR'){
                    $cont_percorridas = 0;
                    $arq_1 = fopen($caminho,"r");
                    While(!feof($arq_1) and $cont_percorridas <=2)
                    {
                        //linha atual do arquivo
                        $linha_1 = fgets($arq_1);
                        $cont_percorridas ++;

                        if ($cont_percorridas == 2)
                        {
                            if(!validaArquivo($Sigla,$Layout, $linha_1, $Tamanho)) $RetornoExistenteAntes = 'V';
                        }
                    }
                    fclose($arq_1);
                }

                $arq = fopen($caminho,"r");

                //inicializa variaveis
                $cont_lidas = 0;
                $cont_percorridas = 0;

                While(!feof($arq)
                    and (($RetornoExistente == 'F') or ($RetornoExistente == 'V' and $tipoRetorno == 'html' ))
                    and ($cont_lidas<$lerQtdeLinhas)
                )
                {
                    //linha atual do arquivo
                    $linha = fgets($arq);

                    if($cont_percorridas >= $_POST['cont']){ //verificação para continuar de onde parou

                        $cont_lidas++;

                        if (($Sigla == 'BS' and $Tamanho == '240') or ($Tamanho == '400'))
                            $ValorPadrao = substr($linha,$ValorPadraoFinal_arq[0],$ValorPadraoFinal_arq[1]);
                        else $ValorPadrao = substr($linha,$ValorPadraoInicial_arq[0],$ValorPadraoInicial_arq[1]) . substr($linha,$ValorPadraoFinal_arq[0],$ValorPadraoFinal_arq[1]);

                        $baixado = 'N';
                        $idBancoin = "and parcelas.banco_id = '".$Layout."'";
                        $idBancoinRet = "and banco_id = '".$Layout."'";

                        if ($cont_percorridas == 0)
                        {

                            if ($Sigla != 'BI' and $Tamanho != '400' and $NumRetorno_arq[0] and $NumRetorno_arq[1]) $NumRetorno = (float) substr($linha,$NumRetorno_arq[0],$NumRetorno_arq[1]);
                            elseif($NumRetorno_arq[0] and $NumRetorno_arq[1])
                            {
                                $NumRetorno = (float) substr($linha,$NumRetorno_arq[0],$NumRetorno_arq[1]);
                                $NumRetorno .= "_".date('Y');
                            }
                            else
                            {
                                $NumRetorno = $DB->Execute("select  case when max(num_retorno) is null then 1 else  
                                    (MAX(CAST(SUBSTRING(num_retorno,1,(LENGTH(num_retorno)-5)) AS UNSIGNED)))+1 end as NumRetorno 
                                    from ocorrencia_retorno where banco_id ='".$Sigla."'")->fields["NumRetorno"];
                                $NumRetorno .= "_".date('Y');
                            }

                            if(empty($_SESSION['DataGerRetorno_'.$sistema])) $_SESSION['DataGerRetorno_'.$sistema] = $DataGerRetorno = substr($linha,$diaDataGerRetorno_arq[0],$diaDataGerRetorno_arq[1]) . '/' . substr($linha,$mesDataGerRetorno_arq[0],$mesDataGerRetorno_arq[1]) . '/' . substr($linha,$anoDataGerRetorno_arq[0],$anoDataGerRetorno_arq[1]);

                            if($Sigla!='BR'){

                                if(!validaArquivo($Sigla,$Layout, $linha, $Tamanho)){
                                    $RetornoExistente = 'V';
                                }else{

                                    $sql =" Select num_retorno as NumRetorno, banco_id as idBanco, id as CodOcorreRet from ocorrencia_retorno where num_retorno='". $NumRetorno ."' ".$idBancoinRet."";

                                    $rs = $DB->Execute($sql);
                                    $existi = $rs->RecordCount();

                                    if($existi==0)
                                    {
                                        $RetornoExistente = 'F';
                                    }
                                    else
                                    {

                                        $RetornoExistente = 'V';
                                        $er[$indice] = $NumRetorno.'|'.$rs->fields['idBanco'].'|'.$rs->fields['CodOcorreRet'];

                                        $nome_arquivo[$indice] =$_POST["nome_arquivo".$i.""];
                                        $indice++;

                                    }


                                }


                            }else{
                                $RetornoExistente = $RetornoExistenteAntes;
                            }

                            if(($RetornoExistente == 'F') and ($tipoRetorno == 'js') and (empty($arquivos_nao_sao_da_conta))){
                                echo "@#@$NumRetorno@#@podeTratarArquivo(";
                                die;
                            }

                        }

                        if ($RetornoExistente == 'F' or ($RetornoExistente == 'V' and $tipoRetorno == 'html' )){

                            //Recebimento dos Valores do Arquivo Texto
                            if ($Sigla == 'CS' or $Sigla == 'CR' or $Sigla == 'SR') $ValorPadraoParametro = '1043'; //CAIXA ECONÔMICA
                            else if($Sigla == 'BB' and $Tamanho == '240') $ValorPadraoParametro = '0013'; // BANCO DO BRASIL - 240
                            else if (($Sigla == 'RS' or $Sigla == 'RC') and $Tamanho == '240') $ValorPadraoParametro = '3563'; // BANCO REAL - 240
                            else if ($Sigla == 'BN' and $Tamanho == '240') $ValorPadraoParametro = '0043'; //BANCO DO NORDESTE - 240
                            else if ($Sigla == 'BS' and $Tamanho == '240') $ValorPadraoParametro = '3'; //BANCO SANTANDER - 240
                            else if ($Sigla == 'BB' and $Tamanho == '400') $ValorPadraoParametro = '7'; // BANCO DO BRASIL - 400
                            else if ((($Sigla == 'RS' or $Sigla == 'RC') and $Tamanho == '400') // BANCO REAL - 400
                                or ($Sigla == 'BR' and $Tamanho == '400') //BANCO BRADESCO SEM REGISTRO - 400
                                or ($Sigla == 'BN' and $Tamanho == '400') //BANCO DO NORDESTE - 400
                                or ($Sigla == 'IT' and $Tamanho == '400') //BANCO ITAU - 400
                                or ($Sigla == 'BS' and $Tamanho == '400') //BANCO SANTANDER - 400
                                or ($Sigla == 'HS' and $Tamanho == '400') //BANCO HSBC - 400
                                or ($Sigla == 'BI' and $Tamanho == '400')) //BIC - BANCO - 400
                                $ValorPadraoParametro = '1';

                            if ($ValorPadrao == $ValorPadraoParametro)
                            {
                                if ($Tamanho == '240')
                                {
                                    if ($Sigla == 'SR' and $Tamanho == '240') //CAIXA ECONÔMICA SIGCB - 240
                                    {

                                        if ((substr($linha,$LinhaT_arq[0],$LinhaT_arq[1]) == 'T') and (($RetornoExistente == 'F') or ($RetornoExistente == 'V' and $tipoRetorno == 'html' ))
                                            //and ((substr($linha,$inicioNossoNumero24_arq[0],$inicioNossoNumero24_arq[1]) == '24')or(substr($linha,$inicioNossoNumero90_arq[0],$inicioNossoNumero90_arq[1]) == '90')or(substr($linha,$inicioNossoNumero024_arq[0],$inicioNossoNumero024_arq[1]) == '024'))
                                        )
                                        {

                                            if((substr($linha,$inicioNossoNumero24_arq[0],$inicioNossoNumero24_arq[1]) == '24')or(substr($linha,$inicioNossoNumero024_arq[0],$inicioNossoNumero024_arq[2]) == '024'))
                                                $NossoNumero = substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                                            if((substr($linha,$inicioNossoNumero90_arq[0],$inicioNossoNumero90_arq[1]) == '90')){
                                                $NossoNumero = substr($linha,$NossoNumero90_arq[0],$NossoNumero90_arq[1]); //NossoNumero  sem o digito verificador

                                                //tratamento para mensalidades migradas da florence
                                                $NossoNumero90 = $DB->Execute("select nosso_numero as nossonumero from parcelas where nosso_numero = '".$NossoNumero."' and banco_id in ( select id from bancos where sigla in ('SR','C'))")->fields['nossonumero'];
                                                if(!$NossoNumero90){
                                                    $NossoNumero90 = $DB->Execute("select nosso_numero as nossonumero from parcelas where LPAD('0',(18 - LENGTH(nosso_numero)),'0')+ nosso_numero like '%".substr($NossoNumero,2)."%' and banco_id in ( select id from bancos where sigla in ('SR','C'))")->fields['nossonumero'];

                                                    if(!empty($NossoNumero90)){
                                                        $NossoNumeroCaixa = $NossoNumero = $NossoNumero90;
                                                    }
                                                }

                                            }

                                            $idcontasareceber = substr($linha,$idcontasareceberT_arq[0],$idcontasareceberT_arq[1]);
                                            $idcontasareceber = (int)$idcontasareceber;
                                            

                                            //Inserção dos Retornos na Tabela Ocorrencia_Retorno (Linha T)

                                            //Geração do Código Sequêncial em CodOcorreRet
                                            $sql = "select MAX(id) as CodOcorreRet from ocorrencia_retorno ";
                                            $rs = $DB->Execute($sql);
                                            if (empty($rs->fields['CodOcorreRet'])) $CodOcorreRet = 1;
                                            else
                                            {
                                                if (($RetornoExistente == 'F') or ($RetornoExistente == 'V' and $tipoRetorno == 'html' )) $CodOcorreRet = $rs->fields['CodOcorreRet'] + 1;

                                            }
                                            //--------------------------

                                            $Descricao = substr($linha,$descricao_arq[0],$descricao_arq[1]);
                                            $NumRetorno = $NumRetorno;

                                            $data1 = explode("/",$DataGerRetorno);
                                            if(strlen($data1[2])==2){
                                                $data1[2] = '20'.$data1[2];
                                            }

                                            $DataRet = $data1[2]."-".$data1[1]."-".$data1[0];;
                                            $DataMov = $DataMovimentacao;
                                            //$idBanco = 'SR';
                                            $idBanco = $Layout;


                                        }

                                    }
                                    else
                                    {

                                        if ((substr($linha,$LinhaT_arq[0],$LinhaT_arq[1]) == 'T') and (($RetornoExistente == 'F') or ($RetornoExistente == 'V' and $tipoRetorno == 'html' ))
                                            //and ((substr($linha,$inicioNossoNumero24_arq[0],$inicioNossoNumero24_arq[1]) == '24')or(substr($linha,$inicioNossoNumero90_arq[0],$inicioNossoNumero90_arq[1]) == '90')or(substr($linha,$inicioNossoNumero024_arq[0],$inicioNossoNumero024_arq[1]) == '024'))
                                        )
                                        {

                                            if(($Sigla == 'CS' or $Sigla=='CR') and $Tamanho == '240') //CAIXA ECONÔMICA SICOB - 240
                                            {
                                                $NossoNumero = substr($linha,$inicioNossoNumero24_arq[0],$inicioNossoNumero24_arq[1]); //NossoNumero  sem o digito verificador
                                                $NossoNumero = $NossoNumero . CalculaDV11NN($NossoNumero); //NossoNumero  sem o digito verificador
                                            }
                                            else if ($Sigla == 'BB' and $Tamanho == '240') // BANCO DO BRASIL - 240
                                            {

                                                $NossoNumero = substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                                                if ((strlen(trim($NossoNumero)) == strlen(RemoveChar(trim($NossoNumero)))) and (substr(trim($NossoNumero),0,1) != '8'))
                                                    $NossoNumero = trim($NossoNumero) . CalculaDV11NN(trim($NossoNumero));

                                            }
                                            else if ((($Sigla == 'RS' or $Sigla == 'RC') and $Tamanho == '240') // BANCO REAL - 240
                                                or ($Sigla == 'BS' and $Tamanho == '240')) //BANCO SANTANDER - 240
                                            {
                                                $NossoNumero = substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                                            }
                                            else if ($Sigla == 'BN' and $Tamanho == '240') //BANCO DO NORDESTE - 240
                                            {
                                                $NossoNumero = str_replace(' ', '',substr($linha,37,20)); //NossoNumero
                                                $countNN     = strlen($NossoNumero);
                                                $NossoNumero = substr($NossoNumero,0,$countNN-1);
                                                $countNN     = strlen($NossoNumero);
                                                $ik = 1;
                                                While ($ik <= (7-$countNN))
                                                {
                                                    $NossoNumero = '0' . $NossoNumero;
                                                    $ik++;
                                                }
                                            }

                                            $idcontasareceber = substr($linha,$idcontasareceberU_arq[0],$idcontasareceberU_arq[1]);

                                            $idcontasareceber = (int)$idcontasareceber;

                                            //Inserção dos Retornos na Tabela Ocorrencia_Retorno (Linha T)

                                            //Geração do Código Sequêncial em CodOcorreRet
                                            $sql = "select MAX(id) as CodOcorreRet from ocorrencia_retorno ";
                                            $rs = $DB->Execute($sql);
                                            if (empty($rs->fields['CodOcorreRet'])) $CodOcorreRet = 1;
                                            else
                                            {
                                                if (($RetornoExistente == 'F') or ($RetornoExistente == 'V' and $tipoRetorno == 'html' )) $CodOcorreRet = $rs->fields['CodOcorreRet'] + 1;

                                            }
                                            //--------------------------

                                            $Descricao = substr($linha,$descricao_arq[0],$descricao_arq[1]);
                                            $NumRetorno = $NumRetorno;
                                            $data1 = explode("/",$DataGerRetorno);
                                            if(strlen($data1[2])==2){
                                                $data1[2] = '20'.$data1[2];
                                            }

                                            $DataRet = $data1[2]."-".$data1[1]."-".$data1[0];;
                                            $DataMov = $DataMovimentacao;

                                            $idBanco = $Layout;

                                        }

                                    }

                                    if (($Sigla == 'BN') and ($Tamanho == '240') //and (in_array(substr($linha,15,2),$arquivosDeTitulos))
                                    )  //BANCO DO NORDESTE - 240
                                    {

                                        if ((substr($linha,$LinhaU_arq[0],$LinhaU_arq[1]) == 'U') and (($RetornoExistente == 'F') or ($RetornoExistente == 'V' and $tipoRetorno == 'html' )) and (in_array(substr($linha,15,2),$arquivosDeTitulos))
                                        )
                                        {
                                            $Valor = ((float)substr($linha,$Valor_arq[0],$Valor_arq[1]))/100;
                                            $DataOcorrencia = substr($linha,$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($linha,$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/' . substr($linha,$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);

                                            $ano = (strlen(substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1])) == 4) ? substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1]) : '20'.substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1]);

                                            $DataCredito = substr($linha,$diaDataCredito_arq[0],$diaDataCredito_arq[1]) . '/' . substr($linha,$mesDataCredito_arq[0],$mesDataCredito_arq[1]) . '/' . $ano;
                                            $DtCredito = ", DtCredito = '" . (substr($DataCredito,6,4) ."-". substr($DataCredito,3,2) ."-". substr($DataCredito,0,2)) ."'";

                                            $sql = "select descricao as Descricao from situacao_pagamento 
                                                where id=(select situacao_pagamento_id from parcelas where nosso_numero = '" . $NossoNumero . "' ".$Condicao." ".$idBancoin.")";
                                            $rs = $DB->Execute($sql);

                                            $ValorEsperado = calcula_valor($DataOcorrencia,$NossoNumero,$DescLayout);
                                            $diferenca = $Valor-$ValorEsperado['valor'];
                                            $sql = "select descricao as Descricao from situacao_pagamento 
                                                where id=(select situacao_pagamento_id from parcelas where nosso_numero = '" . $NossoNumero . "')";
                                            $rs = $DB->Execute($sql);
                                            $Cancelado = '';
                                            if(trim($rs->fields['Descricao'])=='CANCELADO') $Cancelado = 'C';

                                            //{--- Alteração feita por felipe ---}
                                            if(trim($rs->fields['Descricao'])=='NEGOCIADO') $Cancelado = 'N';
                                            //{----------------------------------}

                                            $sql = "select id as id_Situacao_Pagamento from parcelas where nosso_numero = '" . $NossoNumero . "' ".$idBancoin."";
                                            $rs = $DB->Execute($sql);


                                            if((trim($rs->fields['id_Situacao_Pagamento'])=='02')or(trim($rs->fields['id_Situacao_Pagamento'])=='2'))
                                                $Cancelado = 'P';
                                            //coloca a idsituacao
                                            if(($ValorEsperado['valor']>0)or(($ValorEsperado['valor']==0)and($Valor==0) and (!empty($rs->fields['id_Situacao_Pagamento']))))
                                            {
                                                if($diferenca==0)
                                                {
                                                    $Situacao = 'IGN'.$Cancelado;
                                                }
                                                else
                                                {
                                                    if($diferenca>0)
                                                    {
                                                        if($diferenca>$Margem)
                                                            $Situacao = 'MAI'.$Cancelado;
                                                        else
                                                            $Situacao = 'MAN'.$Cancelado;
                                                    }
                                                    else
                                                    {
                                                        if(($diferenca*(-1))>$Margem)
                                                            $Situacao = 'MEI'.$Cancelado;
                                                        else
                                                            $Situacao = 'MEN'.$Cancelado;
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $Situacao = 'NE';
                                            }


                                            //////////////////////////////////////////////////
                                            $sql = "insert into ocorrencia_retorno (id,descricao,num_retorno,
                                                    data_ret,data_mov,banco_id,situacao,boleto_baixado,diferenca,baixa_valor_maior,nao_baixar)
                                                  values('".$CodOcorreRet."','".$Descricao."','".$NumRetorno."','".$DataRet."',
                                                  '".$DataMov."','".$idBanco."','".$Situacao."','N','".$Margem."','". $BaixaValorMaior."','".$NaoBaixar."')";

                                            $rs = $DB->Execute($sql);

                                            $data_auditoria = auditoria($_SESSION['idusuario_g'],'cadastrar',"Retorno Bancario",str_replace("'","",$sql),$GLOBALS[ip]);


                                            //Inserção dos Retornos na Tabela Ocorrencia_Retorno(Linha U)

                                            //Geração do Código Sequêncial em CodOcorreRet
                                            $sql = "select Max(id) as CodOcorreRet from ocorrencia_retorno";
                                            $rs = $DB->Execute($sql);
                                            if (empty($rs->fields['CodOcorreRet'])) $CodOcorreRet = 1;
                                            else
                                            {
                                                $CodOcorreRet = $rs->fields['CodOcorreRet'] + 1;
                                            }
                                            //--------------------------

                                            $Descricao = substr($linha,$descricao_arq[0],$descricao_arq[1]);
                                            $NumRetorno = $NumRetorno;
                                            $data1 = explode("/",$DataGerRetorno);
                                            if(strlen($data1[2])==2){
                                                $data1[2] = '20'.$data1[2];
                                            }

                                            $DataRet = $data1[2]."-".$data1[1]."-".$data1[0];;
                                            $DataMov = $DataMovimentacao;

                                            //////////////////////////////////////////////////
                                            $sql = "insert into ocorrencia_retorno (id,descricao,num_retorno,
                                                    data_ret,data_mov,banco_id,situacao,valor_esperado,boleto_baixado,diferenca,baixa_valor_maior,nao_baixar)
                                                  values('".$CodOcorreRet."','".$Descricao."','".$NumRetorno."',
                                                  '".$DataRet."','".$DataMov."','".$idBanco."','".$Situacao."','".$ValorEsperado['valor']."','N','".$Margem."','". $BaixaValorMaior."','".$NaoBaixar."')";

                                            $rs = $DB->Execute($sql);


                                            //////////////////////////////////////////////////
                                        }
                                    }
                                    else
                                    {

                                        if ((substr($linha,$LinhaU_arq[0],$LinhaU_arq[1]) == 'U') and (($RetornoExistente == 'F') or ($RetornoExistente == 'V' and $tipoRetorno == 'html' )) //and (in_array(substr($linha,15,2),$arquivosDeTitulos))
                                        )
                                        {
                                            $Valor = ((float)substr($linha,$Valor_arq[0],$Valor_arq[1]))/100;
                                            if (($Sigla == 'RS' or $Sigla == 'RC') and $Tamanho == '240') // BANCO REAL - 240
                                            {
                                                $Multa = ((float)substr($linha,17,32))/100;
                                                $sql = "multa as Multa,situacao_pagamento_id as id_Situacao_Pagamento from parcelas where nosso_numero = '" . $NossoNumero . "' or nosso_numero = '" . substr($NossoNumero,6,7) . "' and banco_id in ( select id from bancos where sigla in ('RC','RS'))";
                                                $rs = $DB->Execute($sql);
                                                $id_Situacao_Pagamento = $rs->fields['id_Situacao_Pagamento'];
                                                if($Multa>0)
                                                {
                                                    $Juros = $Multa - $rs->fields['Multa'];
                                                    $Multa = $rs->fields['Multa'];
                                                }
                                            }

                                            $DataOcorrencia = substr($linha,$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($linha,$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/' . substr($linha,$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);

                                            $ano = (strlen(substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1])) == 4) ? substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1]) : '20'.substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1]);

                                            $DataCredito = substr($linha,$diaDataCredito_arq[0],$diaDataCredito_arq[1]) . '/' . substr($linha,$mesDataCredito_arq[0],$mesDataCredito_arq[1]) . '/' . $ano;


                                            $DtCredito = " ,DtCredito = '" . (substr($DataCredito,6,4) ."-". substr($DataCredito,3,2) ."-". substr($DataCredito,0,2)) ."'";

                                            $sql = "select descricao as Descricao from situacao_pagamento where id=(select situacao_pagamento_id from parcelas where nosso_numero = '" . $NossoNumero . "' ".$Condicao." ".$idBancoin.")";
                                            $rs = $DB->Execute($sql);

                                            $ValorEsperado = calcula_valor($DataOcorrencia,$NossoNumero,$DescLayout);

                                            $diferenca = $Valor-$ValorEsperado['valor'];
                                            $sql = "select descricao as Descricao from situacao_pagamento where id=(select situacao_pagamento_id from parcelas where nosso_numero = '" . $NossoNumero . "' ".$idBancoin.")";
                                            $rs = $DB->Execute($sql);
                                            $Cancelado = '';
                                            if(trim($rs->fields['Descricao'])=='CANCELADO') $Cancelado = 'C';

                                            //{--- Alteração feita por felipe ---}
                                            if(trim($rs->fields['Descricao'])=='NEGOCIADO') $Cancelado = 'N';
                                            //{----------------------------------}

                                            if ($DescLayout != 'BANCO REAL - 240')
                                            {
                                                $sql = "select situacao_pagamento_id as id_Situacao_Pagamento from parcelas where nosso_numero = '" . $NossoNumero . "' ".$idBancoin."";
                                                $rs = $DB->Execute($sql);
                                            }

                                            if((trim($rs->fields['id_Situacao_Pagamento'])=='02')or(trim($rs->fields['id_Situacao_Pagamento'])=='2'))
                                                $Cancelado = 'P';

                                            if(($ValorEsperado['valor']>0)or(($ValorEsperado['valor']==0)and($Valor==0)and (!empty($rs->fields['id_Situacao_Pagamento']))))
                                            {
                                                if($diferenca==0)
                                                {
                                                    $Situacao = 'IGN'.$Cancelado;
                                                }
                                                else
                                                {
                                                    if($diferenca>0)
                                                    {
                                                        if($diferenca>$Margem)
                                                            $Situacao = 'MAI'.$Cancelado;
                                                        else
                                                            $Situacao = 'MAN'.$Cancelado;
                                                    }
                                                    else
                                                    {
                                                        if(($diferenca*(-1))>$Margem)
                                                            $Situacao = 'MEI'.$Cancelado;
                                                        else
                                                            $Situacao = 'MEN'.$Cancelado;
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $Situacao = 'NE';
                                            }

                                            $ehBancoReal240 = true;
                                            if ($Sigla != 'RS' and $Sigla != 'RC') $ehBancoReal240 = false;
                                            else if($Tamanho != '240') $ehBancoReal240 = false;

                                            //{ -- verifica duplicidade NEGA BANCO REAL 240-- }
                                            if ($ehBancoReal240 == false)
                                            {
                                                $Duplicado = False;
                                                $diferencaPos = $diferenca;
                                                if($diferencaPos<0) $diferencaPos = $diferencaPos*(-1);
                                                $UtilizaContaReceber = false;
                                                
                                            }


                                            //////////////////////////////////////////////////
                                            $sql = "insert into ocorrencia_retorno (id,descricao,num_retorno,
                                                    data_ret,data_mov,banco_id,situacao,boleto_baixado,diferenca,baixa_valor_maior,nao_baixar
                                                  )
                                                  values('".$CodOcorreRet."','".$Descricao."','".$NumRetorno."','".$DataRet."',
                                                  '".$DataMov."','".$idBanco."','".$Situacao."','N','".$Margem."','". $BaixaValorMaior."','".$NaoBaixar."')";

                                            $rs = $DB->Execute($sql);

                                            //Inserção dos Retornos na Tabela Ocorrencia_Retorno(Linha U)

                                            //Geração do Código Sequêncial em CodOcorreRet
                                            $sql = "select Max(id) as CodOcorreRet from ocorrencia_retorno";
                                            $rs = $DB->Execute($sql);
                                            if (empty($rs->fields['CodOcorreRet'])) $CodOcorreRet = 1;
                                            else
                                            {
                                                $CodOcorreRet = $rs->fields['CodOcorreRet'] + 1;
                                            }
                                            //--------------------------

                                            $Descricao = substr($linha,$descricao_arq[0],$descricao_arq[1]);
                                            $NumRetorno = $NumRetorno;
                                            $data1 = explode("/",$DataGerRetorno);
                                            if(strlen($data1[2])==2){
                                                $data1[2] = '20'.$data1[2];
                                            }

                                            $DataRet = $data1[2]."-".$data1[1]."-".$data1[0];;
                                            $DataMov = $DataMovimentacao;

                                            $idBanco = $Layout;
                                            //////////////////////////////////////////////////
                                            $sql = "insert into ocorrencia_retorno (id,descricao,num_retorno,
                                                    data_ret,data_mov,banco_id,situacao,valor_esperado,boleto_baixado,diferenca,baixa_valor_maior,nao_baixar)
                                                  values('".$CodOcorreRet."','".$Descricao."','".$NumRetorno."',
                                                  '".$DataRet."','".$DataMov."','".$idBanco."','".$Situacao."','".$ValorEsperado['valor']."','N','".$Margem."','". $BaixaValorMaior."','".$NaoBaixar."')";


                                            $rs = $DB->Execute($sql);


                                            //////////////////////////////////////////////////
                                        }
                                    }

                                }
                                else //if(in_array(substr($linha,15,2),$arquivosDeTitulos))
                                {
                                    //layout 400
                                    $NossoNumero = substr($linha,$NossoNumero24_arq[0],$NossoNumero24_arq[1]);//NossoNumero  sem o digito verificador

                                    if ($Sigla == 'BR' and $Tamanho == '400') //BANCO BRADESCO SEM REGISTRO - 400
                                    {
                                        $NossonumeroCompleto = $NossoNumero;

                                        $NossoNumeroSemDigito = substr($linha,70,11);
                                        $Digito = substr($linha,81,1);

                                        $codCarteira = CodCarteira($Layout);

                                        if(!empty($codCarteira) and substr($NossoNumero,0,2) != $codCarteira)
                                            $NossoNumero = trim(CodCarteira($Layout)).$NossonumeroCompleto;
                                        else
                                            $NossoNumero = $NossonumeroCompleto;

                                    }
                                    else
                                    {
                                        if($Sigla!='IT' and $Sigla!='BS' and $Sigla != 'BI'){
                                            if ((strlen(trim($NossoNumero)) == strlen(RemoveChar(trim($NossoNumero)))) and (substr(trim($NossoNumero),0,1) != '8') and $Sigla !='BN' and $Sigla !='HS')
                                                $NossoNumero = trim($NossoNumero) . CalculaDV11NN(trim($NossoNumero));
                                            elseif($Sigla =='HS' and $Tamanho == '400'){
                                                $NossoNumero = trim($NossoNumero);

                                                //tratamento para mensalidades migradas da florence
                                                $NossoNumeroMigrado = $DB->Execute("select nosso_numero as nossonumero from parcelas where nosso_numero = '".$NossoNumero."' and banco_id in ( select id from bancos where sigla in ('HS'))")->fields['nossonumero'];
                                                if(!$NossoNumeroMigrado){
                                                    $NossoNumeroMigrado = $DB->Execute("select nosso_numero as nossonumero from parcelas where nosso_numero = '".(int) substr($NossoNumero,5,5)."' and banco_id in ( select id from bancos where sigla in ('HS'))")->fields['nossonumero'];

                                                    //tratamento para mensalidades migradas da florence
                                                    if(!empty($NossoNumeroMigrado)){
                                                       $NossoNumeroCaixa = $NossoNumero = $NossoNumeroMigrado;
                                                    }
                                                }

                                            }else
                                                $NossoNumero = trim($NossoNumero);
                                        }

                                        if ($Sigla == 'BB' and $Tamanho == '400')   // BANCO DO BRASIL - 400
                                            $idcontasareceber = substr($linha,$idcontasareceberT_arq[0],$idcontasareceberT_arq[1]);

                                    }

                                    //Geração do Código Sequêncial em CodOcorreRet
                                    $sql = "select Max(id) as CodOcorreRet from ocorrencia_retorno";
                                    $rs = $DB->Execute($sql);
                                    if (empty($rs->fields['CodOcorreRet'])) $CodOcorreRet = 1;
                                    else
                                    {
                                        $CodOcorreRet = $rs->fields['CodOcorreRet'] + 1;
                                    }
                                    //--------------------------

                                    $Descricao = substr($linha,$descricao_arq[0],$descricao_arq[1]);
                                    $Descricao1 = substr($linha,240,160);
                                    $NumRetorno = $NumRetorno;
                                    $data1 = explode("/",$DataGerRetorno);
                                    if(strlen($data1[2])==2){
                                        $data1[2] = '20'.$data1[2];
                                    }

                                    $DataRet = $data1[2]."-".$data1[1]."-".$data1[0];;
                                    $DataMov = $DataMovimentacao;

                                    $idBanco = $Layout;
                                    $Valor = ((float)substr($linha,$Valor_arq[0],$Valor_arq[1]))/100;
                                    $Condicao = "";

                                    if((($Sigla == 'RS' or $Sigla == 'RC') and $Tamanho == '400') // BANCO REAL - 400
                                        or
                                        ($Sigla == 'BR' and $Tamanho == '400')) //BANCO BRADESCO SEM REGISTRO - 400
                                    {
                                        //$Multa = (float)(substr($linha,214,13))/100;
                                        //$Juros = (float)(substr($linha,266,13))/100;

                                        if($Sigla == 'BR' and $Tamanho == '400'){
                                            $rs_multa_juros = $DB->Execute("select sm.descricao as Descricao, m.multa as Multa, m.valor as Valor from situacao_pagamento sm
                                                      inner join parcelas m on sm.id=m.situacao_pagamento_id
                                                      where m.nossonumero = '" .$NossoNumero. "'
                                                      and m.banco_id in ( select id from bancos where sigla in ('BR'))");
                                            $Condicao = "";
                                        }else{
                                            $rs_multa_juros = $DB->Execute("select sm.descricao as Descricao, m.multa as Multa, m.valor as Valor from situacao_pagamento sm
                                                      inner join parcelas m on sm.id_Situacao_Pagamento=m.id_Situacao_Pagamento
                                                      where (m.nossonumero like '" .$NossoNumero. "' or m.NossoNumero like '" . substr($NossoNumero,6,7) . "')
                                                      and m.banco_id in ( select id from bancos where sigla in ('RC','RS'))");

                                            $Condicao = "or nosso_numero like '" . substr($NossoNumero,6,7) . "'";
                                        }
                                        $SituacaoMensalidade = $rs_multa_juros->fields['Descricao'];
                                        $DescontoRecebido = 0;
                                        $Multa = 0;
                                        $Juros = 0;
                                        if($Valor > $rs_multa_juros->fields['Valor']) //pagou a mais
                                        {
                                            $Multa = $rs_multa_juros->fields['Multa'];
                                            $diferenca = $Valor - $rs_multa_juros->fields['Valor'];
                                            if($diferenca > $Multa) //pagou com multa e juros
                                                $Juros = $diferenca - $Multa;
                                            else
                                                //pagou só com multa
                                                $Multa = $diferenca;

                                        }
                                        else //desconto e abatimento
                                            $DescontoRecebido = $rs_multa_juros->fields['Valor'] - $Valor;


                                    }
                                    else if (($Sigla == 'BN' and $Tamanho == '400') //BANCO DO NORDESTE - 400
                                        or ($Sigla == 'IT' and $Tamanho == '400') //BANCO ITAU - 400
                                        or ($Sigla == 'BS' and $Tamanho == '400') //BANCO SANTANDER - 400
                                        or ($Sigla == 'HS' and $Tamanho == '400') //BANCO HSBC - 400
                                        or ($Sigla == 'BI' and $Tamanho == '400')) //BIC - BANCO - 400
                                    {
                                        $Taxa = (float)(substr($linha,175,13))/100;
                                        if (($Sigla == 'BN' and $Tamanho == '400') //BANCO DO NORDESTE - 400
                                            or ($Sigla == 'IT' and $Tamanho == '400') //BANCO ITAU - 400
                                            or ($Sigla == 'BS' and $Tamanho == '400')) //BANCO SANTANDER - 400
                                        {
                                            $Valor = $Valor + $Taxa;
                                            if ($Sigla == 'BN' and $Tamanho == '400') //BANCO DO NORDESTE - 400
                                                $Multa = 0.0;//(strtofloat(copy(linha,215,13)))/100;
                                            else if ($Sigla == 'IT' and $Tamanho == '400') //BANCO ITAU - 400
                                                $Multa = (float)(substr($linha,214,13))/100;

                                        }

                                        $Juros = (float)(substr($linha,266,13))/100;

                                        $Condicao = "";

                                         if($Sigla == 'BI' and $Tamanho == '400')
                                             $Condicao = " or nosso_numero like '%".$NossoNumero."%'";


                                    }

                                    $DataOcorrencia = substr($linha,$diaDataOcorrencia_arq[0],$diaDataOcorrencia_arq[1]) . '/' . substr($linha,$mesDataOcorrencia_arq[0],$mesDataOcorrencia_arq[1]) . '/20' . substr($linha,$anoDataOcorrencia_arq[0],$anoDataOcorrencia_arq[1]);

                                    if(!(($Sigla == 'HS' or $Sigla == 'BN') and $Tamanho == '400')
                                        or
                                        (($Sigla == 'HS' or $Sigla == 'BN') and $Tamanho == '400' and substr($linha,0,1) == '0')){
                                        $ano = (strlen(substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1])) == 4) ? substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1]) : '20'.substr($linha,$anoDataCredito_arq[0],$anoDataCredito_arq[1]);

                                        $DataCredito = substr($linha,$diaDataCredito_arq[0],$diaDataCredito_arq[1]) . '/' . substr($linha,$mesDataCredito_arq[0],$mesDataCredito_arq[1]) . '/' . $ano;

                                        $DtCredito = " ,DtCredito = '" . (substr($DataCredito,6,4) ."-". substr($DataCredito,3,2) ."-". substr($DataCredito,0,2)) ."'";
                                    }

                                    $sql = "
                                        select descricao as Descricao from situacao_pagamento 
                                                where id=(select situacao_pagamento_id from parcelas where nosso_numero = '" . $NossoNumero . "' ".$Condicao." ".$idBancoin.")";
                                    $rs = $DB->Execute($sql);

                                    $ValorEsperado = calcula_valor($DataOcorrencia,$NossoNumero, $DescLayout);
                                    $diferenca = $Valor-$ValorEsperado['valor'];

                                    $Cancelado = '';
                                    if(trim($rs->fields['Descricao'])=='CANCELADO') $Cancelado = 'C';

                                    //{--- Alteração feita por felipe ---}
                                    if(trim($rs->fields['Descricao'])=='NEGOCIADO') $Cancelado = 'N';
                                    //{----------------------------------}

                                    $sql = "select situacao_pagamento_id as id_Situacao_Pagamento from parcelas where nosso_numero = '" . $NossoNumero . "'  ".$Condicao." ".$idBancoin."";
                                    $rs = $DB->Execute($sql);


                                    if((trim($rs->fields['id_Situacao_Pagamento'])=='02')or(trim($rs->fields['id_Situacao_Pagamento'])=='2'))
                                        $Cancelado = 'P';

                                    if(($ValorEsperado['valor']>0)or(($ValorEsperado['valor']==0)and($Valor==0)and (!empty($rs->fields['id_Situacao_Pagamento']))))
                                    {
                                        if($diferenca==0)
                                        {
                                            $Situacao = 'IGN'.$Cancelado;
                                        }
                                        else
                                        {
                                            if($diferenca>0)
                                            {
                                                if($diferenca>$Margem)
                                                    $Situacao = 'MAI'.$Cancelado;
                                                else
                                                    $Situacao = 'MAN'.$Cancelado;
                                            }
                                            else
                                            {
                                                if(($diferenca*(-1))>$Margem)
                                                    $Situacao = 'MEI'.$Cancelado;
                                                else
                                                    $Situacao = 'MEN'.$Cancelado;
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $Situacao = 'NE';
                                    }

                                    $rs_seu_numero = '';
                                    if(($Sigla == 'BR' and $Tamanho == '400') //BANCO BRADESCO SEM REGISTRO - 400
                                        or ($Sigla == 'BN' and $Tamanho == '400') //BANCO DO NORDESTE - 400
                                        or ($Sigla == 'IT' and $Tamanho == '400') //BANCO ITAU - 400
                                        or ($Sigla == 'BS' and $Tamanho == '400') //BANCO SANTANDER - 400
                                        or ($Sigla == 'HS' and $Tamanho == '400') //BANCO HSBC - 400
                                        or ($Sigla == 'BI' and $Tamanho == '400')) //BIC - BANCO - 400
                                    {
                                        //////////////////////////////////////////////////
                                        $bb = $Layout;
                                        $Condicao2 = '';

                                        if($Sigla == 'BI' and $Tamanho == '400') //BIC - BANCO - 400
                                        {
                                            //$bb = 'IT';
                                            $Condicao2 = "or nosso_numero like '%" . substr($NossoNumero,6,7) . "%'";
                                        }

                                        $sql_seu_numero = "select seu_numero as SeuNumero from parcelas where nosso_numero = '" . $NossoNumeroCompleto . "' ".$Condicao2." and banco_id = '".$bb."'";

                                        $rs_seu_numero = $DB->Execute($sql_seu_numero);
                                    }

                                    //////////////////////////////////////////////////
                                    $sql = "insert into ocorrencia_retorno (id,descricao,descricao1,num_retorno,
data_ret,data_mov,banco_id,situacao,valor_esperado,boleto_baixado,diferenca,baixa_valor_maior,nao_baixar)
                                            values('".$CodOcorreRet."','".$Descricao."','".$Descricao1."','".$NumRetorno."',
                                            '".$DataRet."','".$DataMov."','".$idBanco."','".$Situacao."','".$ValorEsperado['valor']."','N','".$Margem."','". $BaixaValorMaior."','".$NaoBaixar."')";

                                    $rs = $DB->Execute($sql);


                                    //////////////////////////////////////////////////

                                }
                            }

                            $BaixaBoleto = '1';
                            if(($Situacao == 'MAIC')or($Situacao == 'MAI'))
                            {
                                if( $BaixaValorMaior == 'S') $BaixaBoleto = '1';
                                else $BaixaBoleto = '0';

                            }

                            if ($NaoBaixar != 'S')
                            {

                                $where = ($Sigla == 'BS' and $Tamanho == '400') ?  " substring(parcelas.nosso_numero,6,8) = '" . $NossoNumero . "' " :  " parcelas.nosso_numero = '" . $NossoNumero . "' ";


                                //Passagem dos Valores para a Tabela depois de Lido as Linhas T e U;
                                $sql = "select parcelas.nosso_numero as NossoNumero, movimentacao.cliente_id as Matricula, cliente.Nome as NomeAluno  from parcelas
                                    inner join movimentacao on movimentacao.id = parcelas.movimentacao_id
                                    inner join cliente on cliente.id = movimentacao.cliente_id where ".$where." ".$Condicao." ".$idBancoin."";

                                $rs = $DB->Execute($sql);


                                $NossoNumeroCaixa = $rs->fields['NossoNumero'];
                                $PlanoContaCaixa = $rs->fields['PlanoConta'];

                                if($rs->fields['Matricula'] != '') $MatriculaCaixa = $rs->fields['Matricula'];
                                else $MatriculaCaixa = $rs->fields['idInteressado'];

                                if($rs->fields['Matricula'] != '') $NomeResponsavelCaixa = $rs->fields['NomeAluno'];
                                else $NomeResponsavelCaixa = $rs->fields['NomeInteressado'];

                                if ($rs->RecordCount() != 0
                                    and
                                    (
                                        (
                                            (substr($linha,$LinhaU_arq[0],$LinhaU_arq[1]) == 'U')
                                                and
                                                ($Tamanho=='240')
                                        )
                                            or
                                            (
                                                ($Tamanho == '400')
                                                    and
                                                    ($cont_percorridas != 0)
                                            )
                                    )
                                    and (!$UtilizaContaReceber))
                                {

                                    if ($Tamanho == '400')
                                    {

                                        if ($Sigla == 'HS' and $Tamanho == '400') //BANCO HSBC - 400
                                        {
                                            if ((($Situacao == 'MAIC')or($Situacao == 'MAI')or($Situacao == 'IGN')or($Situacao == 'MEN')or($Situacao == 'MAN')or($Situacao == 'IGNC')or($Situacao == 'MENC')
                                                or($Situacao == 'MANC')) and (!empty($Valor)) and ($cont_percorridas != 0)  and ($BaixaBoleto=='1')
                                                and (
                                                    (substr($linha,108,2) == '06')
                                                        or (substr($linha,108,2) == '07')
                                                        or (substr($linha,108,2) == '15')
                                                        or (substr($linha,108,2) == '16')
                                                        or (substr($linha,108,2) == '32')
                                                        or (substr($linha,108,2) == '36')
                                                        or (substr($linha,108,2) == '92')
                                                        or (substr($linha,108,2) == '93')
                                                        or (substr($linha,108,2) == '94')
                                                        or (substr($linha,108,2) == '31')
                                                        or (substr($linha,108,2) == '33')
                                                        or (substr($linha,108,2) == '38')
                                                        or (substr($linha,108,2) == '39')
                                                ) and($Cancelado != 'N' or $baixarCancelado == 'S')) // and (RetornoExistente = F)
                                            {


                                                try{
                                                    $DB->BeginTrans();

                                                     baixar_parcela($NossoNumero,$situacao_pago,$CodOcorreRet,$usuario_id);    

                                                    $DB->CommitTrans();
                                                    $baixado = 'S';
                                                }catch(ADODB_Exception $e)
                                                {
                                                    $DB->RollbackTrans();
                                                    paraExecucao($e);
                                                    $_SESSION['alert'] .= "Ocorreu um erro no tratamento.  \r\n Descrição do erro: ".$e." \r\nFavor enviar essa mensagem para o Analista responsável.\r\n";
                                                }


                                            }

                                        }
                                        else if ($Sigla == 'BI' and $Tamanho == '400') //BIC - BANCO - 400
                                        {

                                            if ((($Situacao == 'MAIC')or($Situacao == 'MAI')or($Situacao == 'IGN')or($Situacao == 'MEN')or($Situacao == 'MAN')or($Situacao == 'IGNC')
                                                or($Situacao == 'MENC')or($Situacao == 'MANC')) and (!empty($Valor)) and ($cont_percorridas != 0) and ((substr($linha,108,2) == '06')
                                                or (substr($linha,108,2) == '08')or (substr($linha,108,2) == '07'))  and ($BaixaBoleto=='1') and($Cancelado != 'N' or $baixarCancelado == 'S')) // and (RetornoExistente = F)
                                            {


                                                try{

                                                    $DB->BeginTrans();

                                                    $rs = $DB->Execute($sql);

                                                    baixar_parcela($NossoNumeroCaixa,$situacao_pago,$usuario_id);   


                                                    $baixado = 'S';

                                                    $DB->CommitTrans();
                                                }catch(ADODB_Exception $e)
                                                {

                                                    $DB->RollbackTrans();
                                                    paraExecucao($e);
                                                    $_SESSION['alert'] .= "Ocorreu um erro no tratamento.  \r\n Descrição do erro: ".$e." \r\nFavor enviar essa mensagem para o Analista responsável.\r\n";

                                                }
                                            }

                                        }
                                        else if
                                        (
                                            (
                                                (($Sigla == 'RS' or $Sigla == 'RC') and $Tamanho == '400')
                                                and
                                                (
                                                    (substr($linha,108,2) == '06')
                                                    or
                                                    (substr($linha,108,2) == '07')
                                                    or
                                                    (substr($linha,108,2) == '17')
                                                    or
                                                    (substr($linha,108,2) == '05')
                                                )
                                            )// BANCO REAL - 400
                                            or (
                                                ($Sigla == 'BN' and $Tamanho == '400')
                                                and
                                                (
                                                    (substr($linha,108,2) == '06')
                                                    or
                                                    (substr($linha,108,2) == '07')
                                                )
                                            ) //BANCO DO NORDESTE - 400
                                            or (
                                                ($Sigla == 'IT' and $Tamanho == '400')
                                                and
                                                (
                                                    (substr($linha,108,2) == '06')
                                                    or
                                                    (substr($linha,108,2) == '07')
                                                )
                                            )  //BANCO ITAU - 400
                                            or (
                                                ($Sigla == 'BB' and $Tamanho == '400')
                                                and
                                                (
                                                    (substr($linha,108,2) == '05')
                                                    or
                                                    (substr($linha,108,2) == '06')
                                                    or
                                                    (substr($linha,108,2) == '07')
                                                    or
                                                    (substr($linha,108,2) == '08')
                                                    or
                                                    (substr($linha,108,2) == '15')
                                                )
                                            )  //BANCO DO BRASIL - 400
                                            or (
                                                ($Sigla == 'BS' and $Tamanho == '400')
                                                and
                                                (
                                                    (substr($linha,108,2) == '06')
                                                    or
                                                    (substr($linha,108,2) == '07')
                                                )
                                            ) //BANCO SANTANDER - 400
                                            or (
                                                ($Sigla == 'BR' and $Tamanho == '400')
                                                and
                                                (
                                                    (substr($linha,108,2) == '06')
                                                    or
                                                    (substr($linha,108,2) == '15')
                                                    or
                                                    (substr($linha,108,2) == '17')
                                                )
                                            ) //BANCO BRADESCO SEM REGISTRO - 400

                                        )
                                        {
                                            if (
                                                (
                                                    ($Situacao == 'MAIC')
                                                    or($Situacao == 'MAI')
                                                    or($Situacao == 'IGN')
                                                    or($Situacao == 'MEN')
                                                    or($Situacao == 'MAN')
                                                    or($Situacao == 'IGNC')
                                                    or($Situacao == 'MENC')
                                                    or($Situacao == 'MANC')
                                                )
                                                and (!empty($Valor))
                                                and ($cont_percorridas != 0)
                                                and ($BaixaBoleto=='1') and ($Cancelado != 'N' or $baixarCancelado == 'S')) // and (RetornoExistente = F)
                                            {
                                        
                                                try{

                                                    $DB->BeginTrans();

                                                    baixar_parcela($NossoNumero,$situacao_pago,$CodOcorreRet,$usuario_id);  
    
                                                    $baixado = 'S';

                                                    $DB->CommitTrans();
                                                }catch(ADODB_Exception $e)
                                                {
                                                    $DB->RollbackTrans();
                                                    paraExecucao($e);
                                                    $_SESSION['alert'] .= "Ocorreu um erro no tratamento.  \r\n Descrição do erro: ".$e." \r\nFavor enviar essa mensagem para o Analista responsável.\r\n";
                                                }
                                            }
                                        }
                                        else if ((( $Situacao == 'IGN')or($Situacao == 'MEN')or($Situacao == 'MAN')or($Situacao == 'IGNC')or($Situacao == 'MENC')or($Situacao == 'MANC')) and($Cancelado!='N'))  // and (RetornoExistente = F)
                                        {
                                            $Condicao ="";
                                            $podeBaixar = 0;
                                            if (($Sigla == 'BS' and $Tamanho == '240')
                                                and (
                                                    (substr($linha,108,2) == '06')
                                                        or (substr($linha,108,2) == '17')
                                                ))
                                                //BANCO SANTANDER - 240
                                            {
                                                $podeBaixar = 1;
                                                $DtCredito = ",DtCredito = '" . (substr($DataCredito,6,4) ."-". substr($DataCredito,3,2) ."-". substr($DataCredito,0,2)) ."'";
                                            }
                                            else if(($Sigla == 'BR' and $Tamanho == '400')
                                                and
                                                (
                                                    (substr($linha,108,2) == '06')
                                                        or (substr($linha,108,2) == '15')
                                                        or (substr($linha,108,2) == '17')
                                                ))//BANCO BRADESCO SEM REGISTRO - 400
                                            {
                                                $podeBaixar = 1;
                                                $MultaJuros = " ,MultaRecebido = '" . (float)($Multa) . "',JurosRecebido = '" . (float)($Juros) . "'";
                                            }

                                            if($podeBaixar){
                                                try{

                                                    $DB->BeginTrans();
                                                
                                                    baixar_parcela($NossoNumero,$situacao_pago,$CodOcorreRet,$usuario_id);     
                                                    $baixado = 'S';

                                                    $DB->CommitTrans();
                                                }catch(ADODB_Exception $e)
                                                {

                                                    $DB->RollbackTrans();
                                                    paraExecucao($e);
                                                    $_SESSION['alert'] .= "Ocorreu um erro no tratamento.  \r\n Descrição do erro: ".$e." \r\nFavor enviar essa mensagem para o Analista responsável.\r\n";

                                                }
                                            }
                                        }

                                    }
                                    else if(($Sigla == 'RS' or $Sigla == 'RC') and $Tamanho == '240')// BANCO REAL - 240
                                    {

                                        if ((($Situacao == 'MAIC')or($Situacao == 'MAI')or($Situacao == 'IGN')or($Situacao == 'MEN')or($Situacao == 'MAN')or($Situacao == 'IGNC')or($Situacao == 'MENC')or($Situacao == 'MANC')) and (substr($linha,$LinhaU_arq[0],$LinhaU_arq[1]) == 'U') and ($cont_percorridas != 0) and (!empty($Valor)) and ($cont_percorridas != 2) and ((substr($linha,15,2) == '06') or (substr($linha,15,2) == '17')) and ($BaixaBoleto=='1') and($Cancelado != 'N' or $baixarCancelado == 'S'))  // and (RetornoExistente = F)
                                        {

                                            try{

                                                $DB->BeginTrans();

                                                baixar_parcela($NossoNumero,$situacao_pago,$CodOcorreRet,$usuario_id);  
                                                $baixado = 'S';

                                                $DB->CommitTrans();
                                            }catch(ADODB_Exception $e)
                                            {
                                                $DB->RollbackTrans();
                                                paraExecucao($e);
                                                $_SESSION['alert'] .= "Ocorreu um erro no tratamento.  \r\n Descrição do erro: ".$e." \r\nFavor enviar essa mensagem para o Analista responsável.\r\n";

                                            }
                                        }

                                    }
                                    else if (($Sigla == 'BB' and $Tamanho == '240') // BANCO DO BRASIL - 240
                                        or ($Sigla == 'BS' and $Tamanho == '240') //BANCO SANTANDER - 240
                                        or ($Sigla == 'BN' and $Tamanho == '240')) //BANCO DO NORDESTE - 240
                                    {
                                        if (((substr($linha,15,2) == '06')
                                            or(substr($linha,15,2) == '17')) and (substr($linha,$LinhaU_arq[0],$LinhaU_arq[1]) == 'U') and (!empty($Valor)) and ($cont_percorridas != 0) and ($cont_percorridas != 2))  // and (RetornoExistente = F)
                                        {
                                            if (
                                                (
                                                    ($Situacao == 'MAIC')
                                                    or($Situacao == 'MAI')
                                                    or($Situacao == 'IGN')
                                                    or($Situacao == 'MEN')
                                                    or($Situacao == 'MAN')
                                                    or($Situacao == 'IGNC')
                                                    or($Situacao == 'MENC')
                                                    or($Situacao == 'MANC')
                                                )
                                                and (!empty($Valor))
                                                and ($BaixaBoleto=='1') and ($Cancelado != 'N' or $baixarCancelado == 'S')
                                            )  // and (RetornoExistente = F)
                                            {
                                                if ($Sigla == 'BS' and $Tamanho == '240') //BANCO SANTANDER - 240
                                                {

                                                    $DtCredito = ",DtCredito = '" . (substr($DataCredito,6,4) ."-". substr($DataCredito,3,2) ."-". substr($DataCredito,0,2)) ."'";
                                                }
                                                try{

                                                    $DB->BeginTrans();

                                                    baixar_parcela($NossoNumero,$situacao_pago,$CodOcorreRet,$usuario_id);  

                                                    $baixado = 'S';

                                                    $DB->CommitTrans();
                                                }catch(ADODB_Exception $e)
                                                {
                                                    $DB->RollbackTrans();
                                                    paraExecucao($e);
                                                    $_SESSION['alert'] .= "Ocorreu um erro no tratamento.  \r\n Descrição do erro: ".$e." \r\nFavor enviar essa mensagem para o Analista responsável.\r\n";
                                                }
                                            }

                                        }
                                    }
                                    else
                                    {
                                        if ((substr($linha,$LinhaU_arq[0],$LinhaU_arq[1]) == 'U') and (!empty($Valor)) and ($cont_percorridas != 0) and ($cont_percorridas != 2))  // and (RetornoExistente = F)
                                        {
                                            if ((($Situacao == 'IGN')or($Situacao == 'MEN')or($Situacao == 'MAN')or($Situacao == 'IGNC')or($Situacao == 'MENC')or($Situacao == 'MANC')) and($Cancelado != 'N' or $baixarCancelado == 'S') and (!empty($Valor)))  // and (RetornoExistente = F)
                                            {
                                                try{

                                                    $DB->BeginTrans();

                                                    baixar_parcela($NossoNumero,$situacao_pago,$CodOcorreRet,$usuario_id);  
                                                    $baixado = 'S';

                                                    $DB->CommitTrans();
                                                }catch(ADODB_Exception $e)
                                                {
                                                    $DB->RollbackTrans();
                                                    paraExecucao($e);
                                                    $_SESSION['alert'] .= "Ocorreu um erro no tratamento.  \r\n Descrição do erro: ".$e." \r\nFavor enviar essa mensagem para o Analista responsável.\r\n";
                                                }
                                            }
                                        }

                                    }
                                }
                            }

                            //atualiza situacao boleto
                            if (($cont_percorridas != 0) and ($cont_percorridas != 2)
                                and (substr($linha,$LinhaU_arq[0],$LinhaU_arq[1]) == 'U' //and (in_array(substr($linha,15,2),$arquivosDeTitulos))
                                )// gambiarra aki
                            )
                            {
                                if ($baixado == 'S')
                                {
                                    //update ocorrencia retorno
                                    $sql = "update ocorrencia_retorno set boleto_baixado = 'S' where id='".$CodOcorreRet."'";
                                    $rs = $DB->Execute($sql);
                                }
                                else
                                {
                                    //update na mensalidade o retorno caso nao baixado
                                    $sql = " update baixa set ocorrencia_retorno_id = '".$CodOcorreRet."' where parcela_id = 
                                    ( select id from parcelas where nosso_numero = '". $NossoNumero ."' ".$idBancoin." )";
                                    $rs = $DB->Execute($sql);

                                }
                            }


                        }
                        //$cont_arq++;

                    }
                    $cont_percorridas++;

                }
                fclose($arq);
                /*
                //RENOMEANDO O ARQUIVO CRIADO
                $pasta = "arquivos";
                $para = $idBanco."_".$NumRetorno."_".date('Y').substr($de,-4);

                if(empty($er) and !empty($idBanco) and !empty($NumRetorno)){

                    if(file_exists($pasta."/".$para)) unlink($pasta."/".$para);
                    rename($pasta."/".$de, $pasta."/".$para);
                }*/

                if (empty($c)  and !empty($NumRetorno)) $c = $NumRetorno."a";
                else if(!empty($NumRetorno)) $c .= $NumRetorno."a";

                if($cont<$qtd_linhas and $tipoRetorno == 'html' ){
                    //se não chegou ao fim do arquivo
                    //imprimi na tela a barra de progresso
                    exit();
                }

            }

        //proximo arquivo
        $i++;
        }

    }
    catch(Exception $exc){

        paraExecucao($exc);


    }

    if (!empty($er) and $tipoRetorno == 'js')
    {
        echo("Retorno(s) do(s) arquivo(s) ".implode(",",$nome_arquivo).". J� Tratado(s).\n Para trata-lo(s) novamente � necess�rio primeiro exclu�-lo(s).\n");
        //redireciona(URL .'modulos/ocorrencia_retorno/remover.php?c='.implode(",",$e).'&arquivos='.implode(",",$nome_arquivo).'&remover=remover');

        $operacao = "Gostaria de remov�-lo agora?\n";
        $_SESSION['e'] = $er;
        unset($nome_arquivo);
        $redirecionamentos = "redireciona(".URL."/modulos/ocorrencia_retorno/remover.php?remover=removerredireciona(";

        echo $operacao.$redirecionamentos;


        die;
    }

    if(!empty($arquivos_nao_sao_da_conta) and $tipoRetorno == 'js')
    {
        echo(implode("\n",$arquivos_nao_sao_da_conta));

        echo $operacao.$redirecionamentos;
        die;
    }

    if (!empty($c)){

        $_SESSION['c'] = $c;
        $_SESSION['idBanco_retorno'] = $Layout;
        $_SESSION['ano_retorno'] = substr($DataRet,0,4);

    }

    echo $operacao.$redirecionamentos;

}
?>