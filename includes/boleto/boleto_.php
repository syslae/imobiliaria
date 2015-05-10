<?
	include 'funcoesboleto.inc';	
	include '../conexao.php';
    require_once("../verifica_logado.php");
	
	$mat = $_SESSION['mat'];	
	$idParcela = $_GET['parc'];

	$SQL = "select SeuNumero, (select (ltrim(rtrim(str(day(dtVencimento))))+'/'+rtrim(ltrim(str(month(dtVencimento))))+'/'+ ltrim(rtrim(str(year(dtVencimento)))))),";
	$SQL = $SQL." NossoNumero, round(valor,2), matricula,  codCarteira, codBarras, (select (ltrim(rtrim(str(day(dtEmissao))))+'/'+rtrim(ltrim(str(month(dtEmissao))))+'/'+ ltrim(rtrim(str(year(dtEmissao)))))),";
	$SQL = $SQL." idBanco, round(valor*0.0017,2), Mensagem1, Mensagem2, Mensagem3, Mensagem4, Mensagem5, Mensagem6, Mensagem7, Juros from mensalidades where idSituacao = '02'";
	$SQL = $SQL." and matricula = '".$mat."' and parcela = ".$idParcela;
	$res = mssql_query($SQL, $conexao); 
    $linha = mssql_fetch_row($res);
	
	$numDoc = $linha[0];
	$vencimento = $linha[1];
	$nossonumero = trim($linha[2]);
	$nossoNumero = substr($nossonumero,0,strlen($nossonumero)-1)."-".substr($nossonumero,strlen($nossonumero)-1,1);
	$valorDoc = $linha[3];
	$carteira = $linha[5];
	//$mensagem1 = $linha[10];
	$mensagem2 = 'JUROS AO DIA: '.$linha[17];	
	$mensagem3 = $linha[15];
	$mensagem4 = $linha[16];					
	$mensagem5 = $linha[11];
	$mensagem6 = $linha[12].' '.$linha[13];
	//$mensagem7 = $linha[13];
	
	$pos = strpos($valorDoc,".");
	if ($pos == 0)
	  $valorDoc = $valorDoc.",00";
	elseif (strlen(substr($valorDoc,strpos($valorDoc,".")+1,2)) == 2)
	  $valorDoc = str_replace(".",",",$valorDoc);     
	else
	  $valorDoc = str_replace(".",",",$valorDoc."0"); 
	
	//if ($carteira == 20) 
	 // $carteira = "ESP";
	//elseif ($carteira == 14)
	  //$carteira = "SR";
	
	$codBarra = $linha[6];	  
	$dtProcessamento = $dtEmissao = strval($linha[7]);
	$idBanco = $linha[8];
	$juros = $linha[9];
	
	$repNumerica = GeraRepNumericaBanco($codBarra, $idBanco);
	
	$SQL = "select a.nome, a.Endereco, a.Bairro, a.Cidade, a.SiglaEstado, a.cep, (select Descricao from Cursos where a.idCurso = idCurso), a.idCurso, a.BlocoAtual from alunos as a where matricula = '".$mat."'";
	$res = mssql_query($SQL, $conexao); 
    $linha = mssql_fetch_row($res);
	
	$nomeSac = $linha[0];
	$enderecoSac = $linha[1]." - ".$linha[2];
	$cidadeSac = $linha[3];
	$estadoSac = $linha[4];
	$cepSac = $linha[5];
	$curso = $linha[6];
	$idCurso = $linha[7];
	$bloco = $linha[8];
	
	if ($idCurso == 1)
	  $desconto = "10%";
	else 
	  $desconto = "7%";
	
	$SQL = "select mensagem1, mensagem2, mensagem3, mensagem4, mensagem5, mensagem6, AgenciaCodCedente, AgenciaCodCedente2, AgenciaCodCedente3,AgenciaCodCedente4, NomeInstituicao, Mensagem33, Mensagem34, Mensagem35, Mensagem36, Mensagem37, Mensagem38 from parametros";
	$res = mssql_query($SQL, $conexao); 
    $linha = mssql_fetch_row($res);

	
	$nomeCedente = $linha[10];//$linha[8]." / NOVAFAPI";
	//$especieDoc = "DM";
	//$aceite = "N";
	$especie = "R$";
	
	switch ($idBanco)
	{
	 case "CS" : 
	 			$codCedente = $linha[5]; 
				$localPagamento = "CASAS LOTÉRICAS, AG. CAIXA E REDE BANCÁRIAS";
				$codBanco = "104";
				$dvBanco = "0";
				$imgLogo = "cef.gif";
				$especieDoc = "DM";
				$aceite = "N";				
	 			break;
	 case "U" : 
	 			$codCedente = $linha[6]; 
				$localPagamento = "Até o vencimento, pagável em qualquer banco. Após o vencimento, em qualquer agência UNIBANCO mediante consulta no sistema VC";
				$codBanco = "409";
				$dvBanco = "0";
				$imgLogo = "LogoUnibanco.gif";
				$especieDoc = "DM";
				$aceite = "N";				
	 			break;	 
	 case "BB" : 
	 			$codCedente = $linha[7]; 
				$localPagamento = "CASAS LOTÉRICAS, AG. CAIXA E REDE BANCÁRIAS";
				$codBanco = "001";
				$dvBanco = "9";
				$imgLogo = "LogoBB.gif";
				$especieDoc = "DM";
				$aceite = "N";				
	 			break;
	 case "RC" : 
	 			$codCedente = $linha[9]; 
				$localPagamento = "Pagável em qualquer banco, até o vencimento.";
				$codBanco = "356";
				$dvBanco = "5";
				$especieDoc = "RC";
				$imgLogo = "breal.jpg";
				$aceite = "A";								
	 			break;				
	}
	
?>
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<!-- Sistema para geração online de boletos. http://www.boletobancario.com - Licença ESPECIAL - CAIXA -->
<title>Boleto de Cobran&ccedil;a</title>
<script language=JavaScript type=text/javascript src='js/janela.js'></script>

<SCRIPT LANGUAGE="JavaScript">
  function ImprimeBoleto()
	{
		print();
	}
	
  function FechaJanela()
    {
	   window.close();
	}	

</SCRIPT>
<meta http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<link rel=stylesheet href=./css/boleto.css>
</head>
<body topmargin=3 rightmargin=10 bgcolor='#FFFFFF' text='#000000' onLoad="javascript:abrirJanela('aviso.html','480','500','0')">
<!-- Comentar a linha acima e descomentar a linha abaixo para desenvolvimento -->
<!-- <body topmargin=3 rightmargin=10 bgcolor='#FFFFFF' text='#000000'> -->
<table width="100%" border="0" cellspacing="1">
  <tr> 
    <td width="72%"><font size="2"><strong>Instru&ccedil;&otilde;es para impress&atilde;o 
      e pagamento deste bloqueto</strong></font></td>
    <td width="28%"><div align="right"><a href="javascript:ImprimeBoleto()"><img src="./imagens/impress%5B1%5D.gif" alt="Imprimir Boleto" name="druckbutton" width="24" height="21" border="0"></a></div></td>
  </tr>
  <tr> 
    <td><font size="1">- Utilize uma impressora tipo jato de tinta (ink jet) ou 
      laser</font></td>
    <td><div align="right"><a href="javascript:ImprimeBoleto()"><font size="1">Imprimir 
        Boleto</font></a></div></td>
  </tr>
  <tr> 
    <td><font size="1">- Configure a impressora para utilizar qualidade de impress&atilde;o 
      Normal. N&atilde;o utilize as op&ccedil;&otilde;es Rascunho ou Econ&ocirc;mica</font></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><font size="1">- Imprimir em folha A4 (210x297 mm) ou Carta (216x279 mm) 
      de cor branca.</font></td>
    <td><div align="center"></div></td>
  </tr>
  <tr> 
    <td><font size="1">- Corte as linhas indicadas. N&atilde;o fure, dobre, amasse, 
      rasure ou risque o c&oacute;digo de barras.</font></td>
    <td><div align="center"></div></td>
  </tr>
  <tr bgcolor="#F0F0F0"> 
    <td>&nbsp;</td>
    <td> 
      <div align="right"><strong>Recibo do Sacado</strong></div></td>
  </tr>
</table>
<center>
<table border=0 cellPadding=0 cellSpacing=0 width='100%'>
	<tr>
		
      <td width="88%" class=numBanco><img src="./imagens/<?= $imgLogo ?>" width="80" height="20" border="0"> 
        | 
        <?= $codBanco . "-" . $dvBanco ?>
        |</td>
		
      <td class=ipte width='12%'>
        <?= $repNumerica ?>
      </td>
	</tr>
</table>
<table border=1 cellPadding=0 cellSpacing=0 width='100%'>
	<tr class=cellTitle>
		<td width='25%'>Vencimento<br><div align=center><span class=cellBodyD><?= $vencimento ?></span></div></td>
		<td width='25%'>Ag&ecirc;ncia/C&oacute;digo do Cedente<br><span class=cellBody>&nbsp;<?= $codCedente ?></span></td>
		<td width='25%'>N&uacute;mero do Documento<br><span class=cellBody>&nbsp;<?= $numDoc ?></span></td>
		<td width='25%'>Nosso N&uacute;mero/C&oacute;digo Documento<br><span class=cellBody>&nbsp;<?= $nossoNumero ?></span></td>
	</tr>
	<tr class=cellTitle>
		<td width='25%'>(=) Valor do Documento<br><div align=center><span class=cellBodyD><?= $valorDoc ?></span></div></td>
		<td width='25%'>(-) Desconto</td>
		<td width='25%'>(+) Acr&eacute;cimos</td>
		<td width='25%'>(=) Valor Cobrado</td>
	</tr>
</table>
<table border=0 cellPadding=0 cellSpacing=0 width='100%'>
	<tr class=cellTitle>
		<td width=100>Sacado</td><td class=cellBody><?= $mat." - ".$nomeSac ?></td>
		<td><div align=right>-------------- Autentica&ccedil;&atilde;o Mec&acirc;nica 
          --------------</div></td>
	</tr>
	<tr class=cellBody><td>&nbsp;</td><td colSpan=2><?= $enderecoSac ?></td></tr>
	<tr class=cellBody><td>&nbsp;</td><td colSpan=2><?= $cepSac ?>&nbsp;<?= $cidadeSac ?>-<?= $estadoSac ?></td></tr>
	<tr class=cellTitle><td><? //echoSacador/Avalista?></td><td class=cellBody colSpan=2><? //echo $sacadorAvalista ?></td></tr>
</table>

<hr class=divisor noshade size=1>

<table border=0 cellPadding=0 cellSpacing=0 width='100%'>
	<tr>
		
      <td class=numBanco><img  width="80" height="20" border=0 src="./imagens/<?= $imgLogo ?>">
        | 
        <?= $codBanco . "-" . $dvBanco ?>
        |</td>
		<td class=ipte width='*'><?= $repNumerica ?></td>
	</tr>
</table>
<table border=1 cellPadding=0 cellSpacing=0 width='100%'>
	<tr class=cellTitle>
		<td colSpan=5 width=500>Local de Pagamento<br>
        <span class=cellBody>
        <?= $localPagamento ?>
        </span></td>
		<td width=170>Vencimento<br><div align=right><span class=cellBodyD><?= $vencimento ?></span></div></td>
	</tr>
	<tr class=cellTitle>
		<td colspan=5 width=500>Cedente<br><span class=cellBody>&nbsp;<?= $nomeCedente ?></span></td>
		<td width=170>Ag&ecirc;ncia/C&oacute;digo do Cedente<br><div align=right><span class=cellBody><?= $codCedente ?></span></div></td>
	</tr>
	<tr class=cellTitle>
		<td width=85>Data de Emiss&atilde;o<br><span class=cellBody>&nbsp;<?= $dtEmissao ?></span></td>
		<td width=115>N&uacute;mero do Documento<br><span class=cellBody>&nbsp;<?= $numDoc ?></span></td>
		<td width=110>Esp&eacute;cie Doc<br><span class=cellBody>&nbsp;<?= $especieDoc ?></span></td>
		<td width=70>Aceite<br><span class=cellBody>&nbsp;<?= $aceite ?></span></td>
		<td width=120>Data do Processamento<br><span class=cellBody>&nbsp;<?= $dtProcessamento ?></span></td>
		<td width=170>Nosso N&uacute;mero/C&oacute;digo Documento<br><div align=right><span class=cellBody><?= $nossoNumero ?></span></div></td>
	</tr>
	<tr class=cellTitle>
		<td width=85>Uso do Banco<br><span class=cellBody>&nbsp;<? //echo $usoBanco ?></span></td>
		<td width=115>Carteira<br><span class=cellBody>&nbsp;<?= $carteira ?></span></td>
		<td width=110>Esp&eacute;cie<br><span class=cellBody>&nbsp;<?= $especie ?><br></span></td>
		<td width=70>Quantidade<br><span class=cellBody>&nbsp;<? // echo $quantidadeMoeda ?></span></td>
		<td width=110>Valor<br><span class=cellBody>&nbsp;</span></td>
		<td width=170>(=) Valor do Documento<br><div align=right><span class=cellBodyD><?= $valorDoc ?></span></div></td>
	</tr>
	<tr class=cellTitle>
		<td colSpan=5 rowSpan=5>Instru&ccedil;&otilde;es - Texto de responsabilidade do cedente<br>
			<span class=cellBody><b>&nbsp;<?= $mensagem1 ?><br>&nbsp;<? echo $mensagem2 ?><br>&nbsp;<?= $mensagem3 ?><br>
				&nbsp;<?= $mensagem4 ?><br>&nbsp;<?= $mensagem5 ?><br>&nbsp;<?= $mensagem6 ?><br>&nbsp;<? echo $mensagem7 ?></b><br>
			</span>
			<p><span class=cellTitleB><? //echo "Unidade Cedente:"?> <? //echo $unidadeCedente ?></span></p>
	  </td>
		<td width=170>(-) Desconto/Abatimento</td>
	</tr>
	<tr><td class=cellTitle width=170>(-) Outras Dedu&ccedil;&otilde;es</td></tr>
	<tr><td class=cellTitle width=170>(+) Mora/Multa</td></tr>
	<tr><td class=cellTitle width=170>(+) Outros Acr&eacute;cimos</td></tr>
	<tr><td class=cellTitle width=170>(=) Valor Cobrado</td></tr>
	<tr>
		<td colspan=7 width='100%'>
			<table border=0 cellPadding=0 cellSpacing=0 width='100%'>
				<tr>
				<td class=cellTitle width=100>Sacado</td><td class=cellBody colSpan=2><?= $nomeSac ?></td>
				<td class=cellTitle width=100></td><td class=cellBody colSpan=2><?= "<b>Matrícula: </b>".$mat ?></td>
				</tr>
				<tr class=cellBody><td>&nbsp;</td>
				<td colSpan=2><?= $enderecoSac ?></td>
				<td class=cellTitle width=100></td><td class=cellBody colSpan=2><?= "<b>Curso: </b>".$curso ?></td>
				</tr>
				<tr class=cellBody><td>&nbsp;</td>
				<td colSpan=2><?= $cepSac ?>&nbsp;<?= $cidadeSac ?>-<?= $estadoSac ?></td>
				<td class=cellTitle width=100></td><td class=cellBody colSpan=2><?= "<b>Bloco: </b>".$bloco ?></td>
				</tr>
				<tr class=cellTitleB>
					<td><? //echoSacador/Avalista?></td><td class=cellBody><? //echo $sacadorAvalista ?></td>
					<td width=200><? //echo C&oacute;digo de Baixa&nbsp;?><? //echo $codBaixa ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</center>
<table border=0 cellPadding=0 cellSpacing=0 width='100%'>
	<tr><td class=cellTitle><div align=right>Autentica&ccedil;&atilde;o Mec&acirc;nica&nbsp; - Ficha de Compensa&ccedil;&atilde;o</div></td></tr>
</table>
<table width='100%' border=0>
  <tr> 
    <td width=20>&nbsp;</td>
    <td> 
<?
   fbarcode($codBarra);
?>
    </td>
  </tr>
  <tr> 
    <td height="24" colspan="2">
<div align="center"> 
        <hr class=divisor noshade size=1>
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><a href="javascript: FechaJanela()"><img src="imagens/BotaoFecha.gif" width="105" height="20" border="0"></a></div></td>
  </tr>
</table>
</body>
</html>
