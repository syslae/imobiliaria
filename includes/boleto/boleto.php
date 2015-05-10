<?session_start();
$_SESSION["permissao_temp"] = 3;

set_time_limit(10000);
ini_set('memory_limit', '512M');

require_once ("../../config/define.php");
require_once(DOMAIN_PATH."classes/tcpdf/tcpdf.php");
require_once DOMAIN_PATH.'includes/boleto/funcoesboleto.php';
require_once(DOMAIN_PATH."config/conexaoAr.php");
require_once(DOMAIN_PATH."funcoes.inc.php");
require_once(DOMAIN_PATH."funcoesFinanceiro.inc.php");
require_once(DOMAIN_PATH."classes/class_anti_injection.php");
header("Content-type: text/html; charset=ISO-8859-1");
//$DB->debug=1;
//utilizado na impressão do código de barras
$style = array(
		'position' => '',
		'align' => 'C',
		'stretch' => false,
		'fitwidth' => true,
		'cellfitalign' => '',
		'border' => false,
		'hpadding' => 0,
		'vpadding' => 0.8,
		'fgcolor' => array(0,0,0),
		'bgcolor' => false, //array(255,255,255),
		'text' => false,
		'font' => 'helvetica',
		'fontsize' => 8,
		'stretchtext' => 4
);

if(!isset($dados['sac'])){
	if(!isset($_GET['pace']) and !isset($_GET['pace_aluno']))
		verifica ("../../login.php");
}

//INICIALIZA VARIAVEIS

$QtdeBoletosPorPagina = $_POST['QtdeBoletosPorPagina'];
$numero_via = !empty($_POST['numero_via']) ? (int) $_POST['numero_via'] : 1;
$anti = new AntiInjection();

if(isset($_GET['bol'])){

    $parametros = $anti->anti_injection($_GET['bol']);

    $conjunto_nossos_numeros = " and p.id in ('".implode("','",$_GET['bol'])."')";


}

if(isset($_GET['m_id'])){

    $parametros = $anti->anti_injection($_GET['m_id']);

    $conjunto_movimentacao_id = " and p.movimentacao_id in (".$_GET['m_id'].")";


}

//{---------------------------------}

//fim filtros

function arredondado($numero,$decimais)
{
    $fator = pow(10,$decimais);
    return (round($numero * $fator) / $fator);
}

$situacao_pagamento_aberto = $DB->Execute("select id from situacao_pagamento where descricao like '%abert%'")->fields["id"];

$SQL = "select
'BOLETO' as TipoDocumento,p.ano as Ano, p.seu_numero as SeuNumero,
 DATE_FORMAT(p.data_vencimento,'%d/%m/%Y') as vencimento, p.valor, p.nosso_numero as NossoNumero,
c.id as matricula, p.cod_carteira as codCarteira, p.cod_barras as codBarras,
DATE_FORMAT(p.created,'%d/%m/%Y') as dataEmissao, p.banco_id as idBanco,
p.mensagem1 as Mensagem1, p.mensagem2 as Mensagem2, p.mensagem3 as Mensagem3, p.mensagem4 as Mensagem4,
p.mensagem5 as Mensagem5, p.mensagem6 as Mensagem6, p.mensagem7 as Mensagem7, p.mensagem8, p.mensagem9,
p.multa as Multa, p.juros as Juros, p.base_juros as BaseJuros, p.condicao_juros as CondicaoJuros,
p.parcela as NumeroParcela, c.nome as Nome_Aluno, p.sequencial as Sequencial
 from parcelas p
 inner join movimentacao m on m.id = p.movimentacao_id
 inner join cliente c on c.id = m.cliente_id
 inner join situacao_pagamento sp on sp.id = p.situacao_pagamento_id where 1=1 and p.situacao_pagamento_id = '$situacao_pagamento_aberto' and p.status = 1 $conjunto_nossos_numeros $conjunto_movimentacao_id order by m.cliente_id,p.data_vencimento, p.parcela";

$contas_a_receber = $DB->Execute($SQL);
$especie = "R$";
$posicao = 0;
$fim_registros = $contas_a_receber->RecordCount();
$naoQuebrarPagina = 0;
$idBanco_atual = -1; //valor pra representar vazio

while(!$contas_a_receber->EOF)
{
	$nossonumero = trim($contas_a_receber->fields['NossoNumero']);

     $idBanco = $contas_a_receber->fields['idBanco'];

    if($idBanco_atual != $idBanco):
	    if($idBanco and trim($contas_a_receber->fields['TipoDocumento']) == 'BOLETO'):
	        $SQL = "SELECT cnpj as CNPJ,endereco as Endereco, agencia_cod_cedente as AgenciaCodCedente,
              agencia as Agencia,conta as Conta,carteira as Carteira,
	          substring(agencia_cod_cedente,1,4)+substring(agencia_cod_cedente,6,7) as AgenciaCodCedente4,
	          agencia_cod_cedente as AgenciaCodCedenteBR,agencia_cod_cedente as AgCodCedenteSIGCB,nome_boleto as NomeBoleto,
				 bairro as Bairro, cep as CEP, c.nome as Cidade, u.uf as UF, b.nome_instituicao as NomeInstituicao, b.sigla as Sigla, exibir_parcela
	          FROM bancos b
	          left join cidade c on c.id=b.cidade_id
              left join estado u on u.id=b.estado_id
              where b.id='".$idBanco."'";

	    else:

	   		/*$SQL = "SELECT NomeFaculdadeBoleto as NomeBoleto, Endereco, CNPJ, CEP, Fone, PathLogomarca, CidadeAux.Descricao as Cidade, NomeInstituicao as Cedente,
	   		UFAux.UF
	   		FROM Instituicoes
	        left join CidadeAux on CidadeAux.codigo = Instituicoes.Cidade
	        left join UFAux on UFAux.Codigo=Instituicoes.UF
	        where idInstituicao='".$contas_a_receber->fields['idInstituicao']."'";*/

	    endif;

	    $idBanco_atual = $idBanco;
	    $parametros = $DB->Execute($SQL);

	    $nomeCedente = $parametros->fields['NomeInstituicao'];
        $nomeFantasia = $parametros->fields['NomeBoleto'];
	    $enderecoAvalista = $parametros->fields['Endereco'].', '.$parametros->fields['Bairro'].'-'.$parametros->fields['Cidade'].'-'.$parametros->fields['UF'].'-'.$parametros->fields['CEP'];
	    $CnpjAvalista = $parametros->fields['CNPJ'];
	    $cepAvalista = $parametros->fields['CEP'];
	    $foneAvalista = $parametros->fields['Fone'];
	    $especie = "R$";
        $exibir_parcela = $parametros->fields['exibir_parcela'];

    endif;

    $naoQuebrarPagina++;
    $posicao++;

    (!empty($contas_a_receber->fields['matricula'])) ? $mat = $contas_a_receber->fields['matricula'] : false;
    (!empty($contas_a_receber->fields['idInteressado'])) ? $idInteressado = $contas_a_receber->fields['idInteressado'] : false;
    $numDoc = $contas_a_receber->fields['SeuNumero'];
    $vencimento = $contas_a_receber->fields['vencimento'];

    $vencimento = explode("/",$vencimento);
    $vencimento = Completa($vencimento[0],"NI",2).'/'.Completa($vencimento[1],"NI",2).'/'.$vencimento[2];

    $nossonumero = trim($contas_a_receber->fields['NossoNumero']);
    if(trim($parametros->fields['Sigla']) == 'IT'){
        //qryBoletosCodCarteira.Value+'/'+qryBoletosNossoNumero.Value+'-'+DAC10(Agencia+''+Conta5+''+qryBoletosCodCarteira.Value+''+qryBoletosNossoNumero.Value)
        $nossoNumero = $contas_a_receber->fields['codCarteira'].'/'.$nossonumero."-".DAC10(trim($parametros->fields['Agencia']).''.trim($parametros->fields['Conta']).''.trim($contas_a_receber->fields['codCarteira']).''.trim($nossonumero));
    }else{
        $nossoNumero = substr($nossonumero,0,strlen($nossonumero) - 1)."-".substr($nossonumero,	strlen($nossonumero) - 1,1);
    }

    $valorDoc = arredondado($contas_a_receber->fields['valor'],2);
    $carteira = $contas_a_receber->fields['codCarteira'];
    $planoConta = $contas_a_receber->fields['PlanoConta'];
    $numeroParcela = $contas_a_receber->fields['NumeroParcela'];
    $quantidadeParcela = $contas_a_receber->fields['QtdParcela'];
    $mensagemSequencial = (!empty($contas_a_receber->fields['Neg'])) ? 'Seq: '.$contas_a_receber->fields['Sequencial'].' Neg:'.$contas_a_receber->fields['Neg'] : 'Seq: '.$contas_a_receber->fields['Sequencial'];

    //$especie = $contas_a_receber[21];

    //mensagens
    $mensagemMulta = 'MULTA: R$ '.moeda(arredondado($contas_a_receber->fields['Multa'],2)).'';
    $mensagemJuros = 'JUROS AO DIA: R$ '.arredondado($contas_a_receber->fields['Juros'],2).'';
    $mensagemParam1 = $contas_a_receber->fields['Mensagem1'];
    $mensagemParam2 = $contas_a_receber->fields['Mensagem2'];
    $mensagemParam3 = $contas_a_receber->fields['Mensagem3'];
    $mensagemParam4 = $contas_a_receber->fields['Mensagem4'];
    $mensagemParam5 = $contas_a_receber->fields['Mensagem5'];
    $mensagemAluno1 = $contas_a_receber->fields['Mensagem6'];
    $mensagemAluno2 = $contas_a_receber->fields['Mensagem7'];
    $mensagemCurso1 = $contas_a_receber->fields['Mensagem8'];
    $mensagemCurso2 = $contas_a_receber->fields['Mensagem9'];

    $desconto = $contas_a_receber->fields['Desconto'];

    $pos = strpos($valorDoc,".");
    if ($pos == 0) $valorDoc = $valorDoc.",00";
    elseif (strlen(substr($valorDoc,strpos($valorDoc,".") + 1,2)) == 2) $valorDoc =
        str_replace(".",",",$valorDoc);
    else  $valorDoc = str_replace(".",",",$valorDoc."0");

    $codBarra = trim($contas_a_receber->fields['codBarras']);
    $dtProcessamento = $dtEmissao = strval($contas_a_receber->fields['dataEmissao']);
    $idBanco = $contas_a_receber->fields['idBanco'];
    $juros = $contas_a_receber->fields['Juros'];

    //
    $idBanco2 = $idBanco;

    $sigla = trim($parametros->fields['Sigla']);
    #ds.fieldbyname('Sigla').AsString;

    /*if ($sigla == 'BS' or $sigla == 'HS')
          $idBanco = $sigla;*/
    //

    $repNumerica = GeraRepNumericaBanco($codBarra,$sigla);

    $idBanco = $idBanco2;


    //INSTRUCOES DE PAGAMENTO POR DIA UTIL
    $CondicaoJuros = $contas_a_receber->fields['CondicaoJuros'];
    $BaseJuros = $contas_a_receber->fields['BaseJuros'];

    if($CondicaoJuros=='')
    {
        $SQL = 'select condicao_juros as CondicaoJuros,base_juros as BaseJuros from parametro';
        $linha = $DB->Execute($SQL);
        $CondicaoJuros = $linha->fields['CondicaoJuros'];
        $BaseJuros = $linha->fields['BaseJuros'];
    }

    $instrucaoVenc1 = '- Após o vencimento.';
    $instrucaoVenc2 = '- Após o vencimento.';

    if(($CondicaoJuros=='V')||($CondicaoJuros==''))
    {
          $instrucaoVenc1 = '- Após o vencimento.';
          $instrucaoVenc2 = '- Após o vencimento.';
    }
    else
    {
        if($CondicaoJuros=='R')
        {
            $instrucaoVenc1 = '- Após o último dia do mês do vencimento, retroativo ao dia do vencimento.';
            $instrucaoVenc2 = '- Após o vencimento.';

        }
        else
        {
            if($CondicaoJuros=='D')
            {

                if(($BaseJuros=='X')||($BaseJuros==''))
                {
                    $instrucaoVenc1 = '- Considerar estes valores após o 5º dia útil do mês subsequente do vencimento.';
                    $instrucaoVenc2 = '';

                }
                else
                {
                    $instrucaoVenc1 = '- Considerar estes valores após o '.$BaseJuros.'º dia do mês subsequente.';
                    $instrucaoVenc2 = '';

                }
            }
        }
    }

    //echo 'i'.$instrucaoVenc1;


    // parei aki
    if(!empty($mat)){

    $SQL = "select
        cpf, cli.nome, logradouro as Endereco,Bairro,c.nome as Cidade,u.uf as SiglaEstado,cep,numero as Numero
         from cliente cli
         left join cidade c on c.id=cli.cidade_id
         left join estado u on u.id=cli.estado_id where cli.id = '".$mat."'";

    }

    /*if(!empty($idInteressado)){

        $SQL = "SELECT a.cpfcgc as cpf, a.nome, a.Endereco, a.Bairro, ca.Descricao as Cidade, ua.UF as SiglaEstado, a.cep,
				'' as Turma, null as idPredio,
				'' as Descricao, null as idCurso, null as BlocoAtual, a.Numero, '' as Complemento
				from Interessados_Processo as a
				left join CidadeAux ca on a.Cidade = ca.Codigo
				left join UFAux ua on a.UF = ua.Codigo where a.idInteressado = '".$idInteressado."'";

    }*/

    $linha = $DB->Execute($SQL);

    $nomeSac = $linha->fields['nome'];
    $cpfSac = $linha->fields['cpf'];
    $enderecoSac = (!empty($linha->fields['Endereco']) or !empty($linha->fields['Numero'])) ? $linha->fields['Endereco'].', '.$linha->fields['Numero'] : "";
    $cidadeSac = $linha->fields['Cidade'];
    $estadoSac = $linha->fields['SiglaEstado'];
    $cepSac = $linha->fields['cep'];
    $curso = $linha->fields['Descricao'];
    $idCurso = $linha->fields['idCurso'];
    $bloco = $linha->fields['BlocoAtual'];
    $Numero = (!empty($linha->fields[9]) or !empty($linha->fields['Bairro'])) ? $linha->fields[9]." - ".$linha->fields['Bairro'] : "";
    $Complemento = $linha->fields['Complemento'];
    $Turma = $linha->fields['Turma'];
    $Predio = $contas_a_receber->fields['Predio'];

    $cidade_estado = (!empty($cidadeSac) and !empty($estadoSac)) ? $cidadeSac ." - ". $estadoSac : "";

    $enderecoSac2 = (!empty($Complemento) or !empty($cepSac) or !empty($cidade_estado)) ? $Complemento." ".$cepSac ." ". $cidade_estado : "";

    $idBanco2 = $idBanco;

    $sigla = trim($parametros->fields['Sigla']);
    #ds.fieldbyname('Sigla').AsString;

    if ($sigla == 'BS' or $sigla == 'HS')
        $idBanco = $sigla;

    $agencia_cod_cedente_desc = 'Agência/Código do Cedente';

    $intrucoes = 'INSTRUÇÕES DE RESPONSABILIDADE DO BENEFICIÁRIO. '.$planoConta;
    if($exibir_parcela == 'S') $intrucoes .= " Parcela ".$numeroParcela."/".$quantidadeParcela;


    switch ($sigla)
    {

        case "CS":
            $codCedente = $parametros->fields['mensagem6'];
            $localPagamento = "CASAS LOTÉRICAS, AG. CAIXA E REDE BANCÁRIAS";
            $codBanco = "104";
            $dvBanco = "0";
            $imgLogo = "cef.gif";
            $especieDoc = "DM";
            $aceite = "N";
            $carteira = "SR";
            break;
        case "CR":
            $codCedente = $parametros->fields['mensagem6'];
            $localPagamento = "CASAS LOTÉRICAS, AG. CAIXA E REDE BANCÁRIAS";
            $codBanco = "104";
            $dvBanco = "0";
            $imgLogo = "cef.gif";
            $especieDoc = "DM";
            $aceite = "N";
            $carteira = "CR";
            break;
        case "US":
            $codCedente = $parametros->fields['AgenciaCodCedente'];
            $localPagamento = "Até o vencimento, pagável em qualquer banco. Após o vencimento, em qualquer agência UNIBANCO mediante consulta no sistema VC";
            $codBanco = "409";
            $dvBanco = "0";
            $imgLogo = "LogoUnibanco.gif";
            $especieDoc = "DM";
            $aceite = "N";
            break;
        case "BB":
            $codCedente = $parametros->fields['AgenciaCodCedente'];
            $localPagamento = "PAGÁVEL EM QUALQUER BANCO ATÉ O VENCIMENTO";
            $codBanco = "001";
            $dvBanco = "9";
            $imgLogo = "LogoBB.gif";
            $especieDoc = "DM";
            $aceite = "N";
            break;
        case "PC":
            $codCedente = $parametros->fields['AgenciaCodCedente'];
            $localPagamento = "POSTOS DO PAG CONTAS";
            //$codBanco = "001";
            //$dvBanco = "9";
            $imgLogo = "LogoPC.gif";
            $especieDoc = "DM";
            $aceite = "N";
            break;
        case "RC":
            $codCedente = $parametros->fields['AgenciaCodCedente'].CalculaDigitaoBancoReal($nossonumero + $linha->fields['AgenciaCodCedente4']);
            $localPagamento = "Pagável em qualquer banco, até o vencimento.";
            $codBanco = "356";
            $dvBanco = "5";
            $especieDoc = "RC";
            $imgLogo = "logosantander.jpg";
            $aceite = "A";
            break;
        case "RS":
            $codCedente = $parametros->fields['AgenciaCodCedente'].CalculaDigitaoBancoReal($nossonumero.$linha->fields['AgenciaCodCedente4']);
            $localPagamento = "Pagável em qualquer banco, até o vencimento.";
            $codBanco = "356";
            $dvBanco = "5";
            $especieDoc = "RC";
            $imgLogo = "logosantander.jpg";
            $aceite = "A";
            break;
        case "BR":
        case "BI":
            $codCedente = $parametros->fields['AgenciaCodCedenteBR'];
            $localPagamento = "Pagável preferencialmente nas agências do Bradesco.";
            $codBanco = "237";
            $dvBanco = "2";
            $especieDoc = "DM";
            $imgLogo = "bradesco.jpg";
            $aceite = "S";
            break;
        case "SR":
            $codCedente = $parametros->fields['AgCodCedenteSIGCB'];

            //tratamento do digito
            $dvCedente = explode("/",$codCedente);
            $dvCedente = Modulo11(trim($dvCedente[1]),9);
            $codCedente = $codCedente.'-'.$dvCedente;

    		$localPagamento = "CASAS LOTÉRICAS, AG.CAIXA E REDE BANCÁRIA.";
            $codBanco = "104";
            $dvBanco = "0";
            $especieDoc = "DM";
            $imgLogo = "cef.gif";
    		$aceite = "N";
    		$nossoNumero = substr(trim($contas_a_receber->fields['NossoNumero']),0,2) . '/' . substr(trim($contas_a_receber->fields['NossoNumero']),2,15) . '-' . Modulo11(trim($contas_a_receber->fields['NossoNumero']),9);

    		//substr($nossonumero,0,strlen($nossonumero) - 1)."-".substr($nossonumero,	strlen($nossonumero) - 1,1);

            break;

        case "IT":

    		###############################################
    		$sql_banc_bol = " select
                agencia_cod_cedente as AgenciaCodCedente,carteira as Carteira,agencia as Agencia,conta as Conta,
                endereco as Endereco,cep as CEP, u.uf as UF
                from bancos b
                 left join estado u on u.id=b.estado_id where b.id = '$idBanco2'";
    		$rs_banc_bol = $DB->Execute($sql_banc_bol);
    		###############################################

    		//$codCedente = $rs_banc_bol->fields['AgenciaCodCedente'];

            $rs_banc_bol->fields['Agencia'] = trim($rs_banc_bol->fields['Agencia']);
            $rs_banc_bol->fields['Conta'] = trim($rs_banc_bol->fields['Conta']);

    		$codCedente = $rs_banc_bol->fields['Agencia'].'/'.$rs_banc_bol->fields['Conta'].'-'.DAC10($rs_banc_bol->fields['Agencia'].''.$rs_banc_bol->fields['Conta']);
            $localPagamento = "Até o vencimento pague preferencialmente no Itaú.";
            $codBanco = "341";
            $dvBanco = "7";
            $especieDoc = "DP";
            $imgLogo = "itau.gif";
            $aceite = "NÃO";
            $nossoNumero = $rs_banc_bol->fields['Carteira'].'/'.trim($contas_a_receber->fields['NossoNumero']).'-'.DAC10($rs_banc_bol->fields['Agencia'].''.$rs_banc_bol->fields['Conta'].''.$rs_banc_bol->fields['Carteira'].''.trim($contas_a_receber->fields['NossoNumero']));
            $enderecoBeneficiario = $rs_banc_bol->fields['Endereco']." - ".$rs_banc_bol->fields['CEP']." - ".$rs_banc_bol->fields['UF'];

    		$agencia_cod_cedente_desc = 'Agência/Código do Beneficiário';

            break;

        case "HS":
    		###############################################
    		$sql_banc_bol = " select agencia_cod_cedente as AgenciaCodCedente from bancos where b.id = '$idBanco2'";
    		$rs_banc_bol = $DB->Execute($sql_banc_bol);
    		###############################################

            $especieDoc = "PD";
            $carteira = "CSB";
            $codCedente = $rs_banc_bol->fields['AgenciaCodCedente'];
            $localPagamento = "Pagável em qualquer Banco até o vencimento";
            $codBanco = "399";
            $dvBanco = "9";
            $imgLogo = "logohsbc.jpg";
            break;

        case "BS":
    		###############################################
    		$sql_banc_bol = " select agencia_cod_cedente as AgenciaCodCedente from bancos where b.id = '$idBanco2'";
    		$rs_banc_bol = $DB->Execute($sql_banc_bol);
    		###############################################

    		$codCedente =$rs_banc_bol->fields['AgenciaCodCedente'];
            $localPagamento = "	Pagável em qualquer Banco até o vencimento";
            $codBanco = "033";
            $dvBanco = "7";
            $imgLogo = "logosantander.jpg";
            break;
    	case "BN":
    		$codCedente = $parametros->fields['AgenciaCodCedente'];
    		$localPagamento = "PAGÁVEL EM QUALQUER AGÊNCIA BANCÁRIA ATÉ O VENCIMENTO";
    		$codBanco = "004";
    		$dvBanco = "3";
    		$imgLogo = "logoBN.jpg";
    		$especieDoc = "DM";
    		$aceite = "N";
            $nossoNumero = trim($contas_a_receber->fields['NossoNumero']) . '-' . Modulo11(trim($contas_a_receber->fields['NossoNumero']),9);

            break;
    }
    //die;
    $pdf->SetFont('helvetica', '', 7);
    $pdf->SetTextColor(68,68,68);

    $w = array(30,2,105,125,40,25,62.5,165,20,13.75,33,80);
    $h = array(3.6,3,2,6);
    $w_recibo = array(120,50,142,192,96);
    $h_recibo = array(6,32);
    $sistema_desc = ($sistema == 'g') ? strtoupper ('gflex') : strtoupper($sistema);

    switch(trim($contas_a_receber->fields['TipoDocumento'])){
    	case 'BOLETO':

            $conteudo_curso = "";
            $conteudo_turma = "";
            $conteudo_predio = "";
            $conteudo_cpf = (!empty($cpfSac)) ? utf8_encode("CPF: ".$cpfSac) : "";


    		include(DOMAIN_PATH."includes/boleto/impressao_boleto_pagina.php");
    		break;
    	case 'RECIBO':

    		$pdf->SetFont('helvetica', '', 11);
    		$cidade = $parametros->fields['Cidade'];
    		$via = array( 1 => '1ª Via - ALUNO OU RESPONSÁVEL ', 2 => '2ª Via - SECRETARIA', 3 => '3ª Via - FINANCEIRO');
    		$imgLogo = $parametros->fields['PathLogomarca'];
    		$dataEmissao = date('d/m/Y');
    		$hora = date('H:i:s');

    		$data1 = dataBrasileira();
    		$data1 = explode(",",$data1);

    		for($k = $numero_via; $k <= 3;$k++):

    		$posicao_via = $k;

    		include(DOMAIN_PATH."includes/boleto/impressao_recibo_pagina.php");

    		if($posicao == '3' and $naoQuebrarPagina != $fim_registros)
    		{
    			$posicao = 0;
    		}

    		if($k != 3) $posicao++;
    		endfor;

    		break;
    	case 'CARNE':
    		$localPagamento = 'Pagável no caixa da instituição.';
    		include(DOMAIN_PATH."includes/boleto/impressao_carne_pagina.php");
    		break;

    }

    if($posicao == '3' and $naoQuebrarPagina != $fim_registros)
    {
        $posicao = 0;
    }
    $contas_a_receber->MoveNext();

}
?>