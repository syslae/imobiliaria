<?php
function GeraCodBarras($data,$valor, $nossoNumero, $tipoBanco)
{
	global $DB;
    //$DB->debug = 1;

	$idBanco = $tipoBanco;
	$sql = "select sigla from bancos where id='".$tipoBanco."'";
	$rs = $DB->Execute($sql);
	$Sigla = trim($rs->fields['sigla']);
    $tipoBanco = $Sigla;
	
	if(($tipoBanco != 'IT')&&($tipoBanco != 'BS')&&($tipoBanco != 'BI')&&($tipoBanco != 'HS'))
	{
		$sql = "select Substring(agencia_cod_cedente,13,5) as CodCedente, Substring(agencia_cod_cedente,1,4) as Agencia, agencia_cod_cedente as AgenciaCodCedente11pos,
			 agencia_cod_cedente as AgenciaCodCedenteSinco,substring(agencia_cod_cedente,1,4) as CodCedente2,
			 substring(agencia_cod_cedente,6,8) as CodCedente3,num_convenio as NumConvenio2,
			 substring(num_convenio,1,7) as NumConvenio,substring(agencia_cod_cedente,1,4) as CodCedente4,
			 substring(agencia_cod_cedente,6,12) as CodCedente5,digito_conta as DVConta5,conta as Conta5,
			 substring(agencia_cod_cedente,1,4) as AgSIGCB,substring(agencia_cod_cedente,6,6) as CodCedenteSIGCB,
			 substring(agencia_cod_cedente,1,4) as AgBNB,
			 substring(agencia_cod_cedente,6,7) as CodCedenteBNB,substring(agencia_cod_cedente,14,1) as DvBNB, carteira as CarteiraBNB,
			 substring(agencia_cod_cedente,1,4) as AgBR, substring(agencia_cod_cedente,6,12) as AgBR2,digito_conta as DVContaBR,conta as ContaBR, carteira,
			  rtrim(ltrim(tipo_carteira)) as TipoCarteira from bancos where id='".$idBanco."'";
	
        $rs = $DB->Execute($sql);
	}
	else
	{
	  	if(($tipoBanco != 'BS')&&($tipoBanco != 'HS'))
		{
	    	$sql = "select agencia, conta, carteira, radical, matricula_banco, substring(agencia_cod_cedente,10,7) as ContaBic,
	    		substring(agencia_cod_cedente,1,4) as AgenciaBic from bancos where id='".$idBanco."'";
	    	$rs = $DB->Execute($sql);
		}
	  	else
	    {
	      	$sql = "select agencia, conta, carteira, radical, matricula_banco, sigla,
		      	CAST(SUBSTRING(agencia_cod_cedente,LENGTH(agencia_cod_cedente)-8,9) AS UNSIGNED) as CodigoCedente
		      	from bancos where id='".$idBanco."'";
	      	$rs = $DB->Execute($sql);
	      	$tipoBanco = trim($rs->fields['sigla']);
	    }
	
	}
	
	if ($tipoBanco == 'CS') 
	{
		$codCedente = trim($rs->fields['CodCedente']);
	  	$agencia = trim($rs->fields['Agencia']);
	  	$valor = number_format($valor, 2, '.', '');
	  	return GeraNumCodBarras('9', $data, $valor, $codCedente, $agencia, substr($nossoNumero,1,14));
	}
	
	if ($tipoBanco == 'CR') 
	{
	  	$codCedente = trim($rs->fields['AgenciaCodCedente11pos']);
	  	$valor = number_format($valor, 2, '.', '');
	  	$codBarra = GeraNumCodBarras11PosCEF('9', $data, $valor, substr($codCedente,0,15), substr($nossoNumero,0,10));
	  	return $codBarra;  
	}
	
	if ($tipoBanco == 'SR') 
	{
		$codCedente = trim($rs->fields['CodCedenteSIGCB']);
	  	$agencia = trim($rs->fields['AgSIGCB']);
	  	$dvCodCedente = Modulo11($codCedente,9);
	  	$valor = number_format($valor, 2, '.', '');
	  	return GeraNumCodBarrasSIGCB($data,$valor,$nossoNumero,$codCedente,$dvCodCedente);
	}
	
  	if ($tipoBanco == 'US'){
      	$NumeroConvenio =  trim($rs->fields['NumConvenio2']);
      	$valor = number_format($valor, 2, '.', '');

      	return GeraNumCodBarrasUnibanco('9', $data, $valor, $NumeroConvenio, $nossoNumero, $NumeroConvenio, $nossoNumero);
  	}
  		
	if($tipoBanco == 'BB'){
	    $NumeroConvenio = trim($rs->fields['NumConvenio']);
	    $valor = number_format($valor, 2, '.', '');
        $TipoCarteira =  trim($rs->fields['TipoCarteira']);

	    return GeraNumCodBarrasBB('9', $data, $valor, $NumeroConvenio, substr($nossoNumero,7,10), $TipoCarteira);
	}
	
    //pag contas
    if($tipoBanco == 'PC'){
        $valor = number_format($valor, 2, '.', '');
        return GeraNumCodBarrasPagContas($data, $valor, $nossoNumero, $idBanco);
    }

	if($tipoBanco == 'RS'){
		$CodCedente = trim($rs->fields['CodCedente3']);
	    $Agencia = trim($rs->fields['CodCedente2']);
	    $valor = number_format($valor, 2, '.', '');
	    return GeraNumCodBarrasBancoReal('9', $data, $valor, $Agencia, $CodCedente, $nossoNumero);
	}
	
	if($tipoBanco == 'RC'){
		$CodCedente = trim($rs->fields['CodCedente3']);
	    $Agencia = trim($rs->fields['CodCedente2']);
	    $valor = number_format($valor, 2, '.', '');
	   	return GeraNumCodBarrasBancoRealRegistrado('9', $data, $valor, $Agencia, $CodCedente, $nossoNumero);
	}
		
	if($tipoBanco == 'RU'){
		$CodCedente = trim($rs->fields['CodCedente5']);
	    $Agencia = trim($rs->fields['CodCedente4']);
	    $DVConta5 = trim($rs->fields['DVConta5']);
	    $Conta5 = trim($rs->fields['Conta5']);
	    $valor = number_format($valor, 2, '.', '');
	    return GeraNumCodBarrasBancoRural($data,$valor,'19',$nossoNumero,$Agencia,$Conta5,$DVConta5);
	}
	
	if($tipoBanco == 'BN'){
		$CodCedente = trim($rs->fields['CodCedenteBNB']);
	    $Agencia = trim($rs->fields['AgBNB']);
	    $DvCodCedente = trim($rs->fields['DvBNB']);
	    $DvNossoNumero = Modulo11($nossoNumero);
	    $valor = number_format($valor, 2, '.', '');
	    return GeraNumCodBarrasBNB($Agencia,$data,$valor,$nossoNumero,$DvNossoNumero,$CodCedente,$DvCodCedente,$rs->fields['CarteiraBNB']);
	}
	
	
	if($tipoBanco == 'BR'){
		$CodCedente = trim($rs->fields['AgBR2']);
	    $Agencia = trim($rs->fields['AgBR']);
	    $DVConta5 = trim($rs->fields['DVContaBR']);
	    $Conta5 = trim($rs->fields['ContaBR']);
	    $valor = number_format($valor, 2, '.', '');
        $Carteira = trim($rs->fields['Carteira']);
	    return GeraNumCodBarrasBancoBradesco($data,$valor,$Carteira,$nossoNumero,$Agencia,$Conta5,$DVConta5);
	}
	
	if($tipoBanco == 'IT'){
		$Conta5 = trim($rs->fields['Conta']);
	    $Agencia = trim($rs->fields['Agencia']);
	    $Carteira = trim($rs->fields['Carteira']);
	    $valor = number_format($valor, 2, '.', '');
	    return GeraNumCodBarrasITAU($Agencia,$data,$valor,$nossoNumero,$Conta5,$Carteira);
	}
	
	if($tipoBanco == 'BS'){
		$Conta5 = trim($rs->fields['CodigoCedente']);
	    $Agencia = trim($rs->fields['Agencia']);
	    $Carteira = trim($rs->fields['Carteira']);
	    $valor = number_format($valor, 2, '.', '');
	    return GeraNumCodBarrasSANTANDER($Agencia,$data,$valor,$nossoNumero,$Conta5,$Carteira);
	}
	
	if($tipoBanco == 'BI'){
		$Conta5 = trim($rs->fields['ContaBic']);
	    $Agencia = trim($rs->fields['AgenciaBic']);
	    $Carteira = trim($rs->fields['Carteira']);
	    $Radical = trim($rs->fields['Radical']);
	    $cliente_idBanco = trim($rs->fields['MatriculaBanco']);
	    $valor = number_format($valor, 2, '.', '');
	    return GeraNumCodBarrasBancoBIC($data,$valor,$Carteira,$nossoNumero,$Agencia,$Conta5,$Radical,$cliente_idBanco);
	}
	
	if($tipoBanco == 'HS'){
		$Conta5 = trim($rs->fields['Conta']);
	    $Agencia = trim($rs->fields['Agencia']);
	    $Carteira = trim($rs->fields['Carteira']);
	    $valor = number_format($valor, 2, '.', '');
	   	return GeraNumCodBarrasHSBC($Agencia,$data,$valor,$nossoNumero,$Conta5,$Carteira);
	}
}

function GeraNumCodBarrasPagContas($DtVencimento, $Valor, $NossoNumeroPos, $idBanco)
{
    global $DB;

    $identProduto = '8'; //constante ?8? para identificar arrecadação
    $identSegmento = '6'; //código 6 para Carnes e Assemelhados ou demais Empresas / Órgãos  que   serão identificadas através do CGC.
    $identValorMensalidade = '7'; //código 6 boleto sem descconto, 7 boleto com desconto
    $ValorMensalidade = FormataValorBoleto($Valor,12);

    //busca os 8 primeiros caracteres do C.G.C. para identificar a Empresa/Órgão
    $sql= "select SUBSTRING(replace(replace(replace(CNPJ,'.',''),'/',''),'-',''),1,8) as cnpj from Bancos where id='".$idBanco."'";
    $ds = $DB->Execute($sql);

    $identEmpresa = Completa(trim($ds->fields['cnpj']),'NI',8);

    $dados_vencimento = explode("/",$DtVencimento);
    $campoLivre = $dados_vencimento[2].Completa($dados_vencimento[1],'NI',2).Completa($dados_vencimento[0],'NI',2).Completa(substr($NossoNumeroPos,0,-2),'NI',13); //DtVencimento AAAAMMDD

    $NumCalDigVerificador = $identProduto.$identSegmento.$identValorMensalidade.$ValorMensalidade.$identEmpresa.$campoLivre;
    $DigitoVerificador = DAC10($NumCalDigVerificador); //Dígito de auto conferência dos dados contidos  no Código de Barras

    $CodBarras = $identProduto.$identSegmento.$identValorMensalidade.$DigitoVerificador.$ValorMensalidade.$identEmpresa.$campoLivre;

    return $CodBarras;
}

function GeraNumCodBarras($CodMoeda, $DtVencimento, $Valor, $CodCedente, $Agencia, $NossoNumero)
{

	$identBanco = '104';
	// CodCarteira := '8';
	$CodCarteira = '9';
	$Constante = '7';
	/*$i= 0;
	$ValorMensalidade = RemoveChar($Valor);
	while($i <=(9- strlen($Valor))){
		 $ValorMensalidade = '0'.$ValorMensalidade;
		 $i++;
	}*/
	$ValorMensalidade = FormataValorBoleto($Valor,11);
	
	$DataFator = '07/10/1997';
	$Fator = DiferencaDias($DataFator, $DtVencimento);
	$NumCalDigVerificador = $identBanco.$CodMoeda.$Fator.$ValorMensalidade.$CodCedente.$Agencia.$CodCarteira.$Constante.$NossoNumero;
	$DigitoVerificador = CalculaDV11($NumCalDigVerificador);
	$CodBarras = $identBanco.$CodMoeda.$DigitoVerificador.$Fator.$ValorMensalidade.$CodCedente.$Agencia.$CodCarteira.$Constante.$NossoNumero;
	return  $CodBarras;

}

function GeraNumCodBarras11PosCEF($codMoeda,$dtVencimento,$valor,$codCedente,$nossoNumero)
{
	
     //identBanco := '104';
	$identBanco = '104';
	//i:= 0;
    $i = 0;
    
	/*$valorMensalidade = RemoveChar($valor);
    $tamanho_valor = strlen($valor);
   	while ($i <= (9-$tamanho_valor))
       {$valorMensalidade = '0'.$valorMensalidade;
         $i++;
       }*/
    
    $valorMensalidade = FormataValorBoleto($valor,11);
    
	$dataFator = '07/10/1997';
	
	//Fator := DiferencaDias(DataFator, DtVencimento);     	
	//$fator = $this->DiferencaDias($dataFator, $dtVencimento);
	$fator = diffDate($dataFator, $dtVencimento, "D","/");
	
	//NumCalDigVerificador := identBanco + CodMoeda + Fator + ValorMensalidade + NossoNumero + CodCedente;
     $numCalDigVerificador = $identBanco.$codMoeda.$fator.$valorMensalidade.$nossoNumero.$codCedente;
     
	//DigitoVerificador := inttostr(CalculaDV11(NumCalDigVerificador));
	$digitoVerificador = CalculaDV11($numCalDigVerificador);
	
	//CodBarras := identBanco + CodMoeda + DigitoVerificador + Fator + ValorMensalidade + NossoNumero + CodCedente;
     $codBarras = $identBanco.$codMoeda.$digitoVerificador.$fator.$valorMensalidade.$nossoNumero.$codCedente;
     
	 //result := CodBarras;
	return $codBarras;
}

function GeraNumCodBarrasSIGCB($DtVencimento,$Valor,$NossoNumero,$CodigoCedente,$DvCodigoCedente)
{

	/*
	A primeira parte do código de barras será calculada automaticamente.
	Ela é composta por:
	Código do banco (3 posições)
	Código da moeda = 9 (1 posição)
	(1 posição) - Será calculado e incluído pelo componente
	Fator de vencimento (4 posições) - Obrigatório a partir de 03/07/2000
	Valor do documento (10 posições) - Sem vírgula decimal e com ZEROS à esquerda
	
	A segunda parte do código de barras é um campo livre, que varia de acordo
	com o banco. Esse campo livre será calculado por esta função (que você deverá
	alterar de acordo com as informações fornecidas pelo banco).
	
	
	Segunda parte do código de barras - Campo livre - Varia de acordo com o banco*/
	$CodigoBanco = '104';
	$CodigoMoeda = '9';
	$FatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');
	//$ValorDocumento = str_pad($Valor*100, 10, "0", STR_PAD_LEFT);
	$ValorDocumento = FormataValorBoleto($Valor,11);
	$ICampoLivre = $CodigoCedente.$DvCodigoCedente.substr($NossoNumero,2,3).substr($NossoNumero,0,1).substr($NossoNumero,5,3).substr($NossoNumero,1,1).substr($NossoNumero,8,9);
	$DvCampoLivre = Modulo11($ICampoLivre,9);
	$CampoLivre = $ICampoLivre.$DvCampoLivre;
	$ICodigoBarras= $CodigoBanco.$CodigoMoeda.$FatorVencimento.$ValorDocumento.$CampoLivre;
	$DigitoCodigoBarras = Modulo11($ICodigoBarras,9);
	if($DigitoCodigoBarras == '0'){
		$DigitoCodigoBarras = '1';
	}
	
	return substr($ICodigoBarras,0,4).$DigitoCodigoBarras.substr($ICodigoBarras,4,strlen($ICodigoBarras)-4);
}

function GeraNumCodBarrasUnibanco($CodMoeda,$DtVencimento,$Valor,$CodCedente,$NossoNumero,$NumConvenio,$NossoNumero14Pos)
{

	$identBanco = '409';
    $CodPadrao = '5';
    $vago = '00';
    
	/*$i= 0;
    $ValorMensalidade = RemoveChar($Valor);
    While ($i <= (9-(strlen((string)$Valor))))
   	{
    	$ValorMensalidade = '0'.$ValorMensalidade;
        $i++;
    }*/
    
    $ValorMensalidade = FormataValorBoleto($Valor, 11);

    $DataFator = '03/07/2000';
    $Fator = DiferencaDiasUnibanco($DataFator, $DtVencimento);
    $NumCalDigVerificador = $identBanco.$CodMoeda.$Fator.$ValorMensalidade.$CodPadrao.$NumConvenio.$vago.$NossoNumero14Pos;
    $DigitoVerificador = CalculaDV11($NumCalDigVerificador);
    $CodBarras = $identBanco.$CodMoeda.$DigitoVerificador.$Fator.$ValorMensalidade.$CodPadrao.$NumConvenio.$vago.$NossoNumero14Pos;//CodCedente + Agencia + CodCarteira + Constante + NossoNumero;
    return $CodBarras;
}

function GeraNumCodBarrasBB($CodMoeda, $DtVencimento, $Valor, $NumConvenio, $NossoNumero18PosBB, $TipoCarteira)
{
	global $DB;
	
    $identBanco = '001';
    $vago = '000000';
    //Busca do tipo de carteira do Banco do Brasil (Se carteira 17: sem registro; Se carteira 18: com registro)
    /*$sql= "Select rtrim(ltrim(TipoCarteira)) as TipoCarteira from bancos where sigla='BB'";
    $ds = $DB->Execute($sql);
    $TipoCarteira = $ds->fields['TipoCarteira'];*/
	/*$i = 0;
    $ValorMensalidade = RemoveChar($Valor);
    While ($i <= (9-strlen((string)$Valor)))
    {
    	$ValorMensalidade = '0'.$ValorMensalidade;
       	$i++;
    }*/
    $ValorMensalidade = FormataValorBoleto($Valor,11);
    
	$DataFator = '07/10/1997';
    $Fator = DiferencaDias($DataFator, $DtVencimento);
    
	$NumCalDigVerificador = $identBanco.$CodMoeda.$Fator.$ValorMensalidade.$vago.$NumConvenio.$NossoNumero18PosBB.$TipoCarteira;
    $DigitoVerificador = CalculaDV11($NumCalDigVerificador);
    $CodBarras = $identBanco.$CodMoeda.$DigitoVerificador.$Fator.$ValorMensalidade.$vago.$NumConvenio.$NossoNumero18PosBB.$TipoCarteira;
    return $CodBarras;
}

function GeraNumCodBarrasBancoReal($CodMoeda, $DtVencimento, $Valor, $Agencia, $Conta, $NossoNumero13Pos)
{
	$identBanco = '356';
    
	/*$i= 0;
    $ValorMensalidade = RemoveChar($Valor);
    While ($i <= (9-strlen($Valor)))
    {
    	$ValorMensalidade = '0'.$ValorMensalidade;
        $i++;
    }*/
    $ValorMensalidade = FormataValorBoleto($Valor,11);
    
    $DataFator = '03/07/2000';
    $Fator  = DiferencaDiasUnibanco($DataFator, $DtVencimento);
    $NumCalDigitao = $NossoNumero13Pos.$Agencia.substr($Conta,0,7);
    $Digitao = CalculaDigitaoBancoReal($NumCalDigitao);
    $NumCalDigVerificador = $identBanco.$CodMoeda.$Fator.$ValorMensalidade.$Agencia.substr($Conta,0,7).$Digitao.$NossoNumero13Pos;
    $DigitoVerificador = CalculaDV11($NumCalDigVerificador);
    $CodBarras = $identBanco.$CodMoeda.$DigitoVerificador.$Fator.$ValorMensalidade.$Agencia.substr($Conta,0,7).$Digitao.$NossoNumero13Pos;
    return $CodBarras;
}

function GeraNumCodBarrasBancoRealRegistrado($CodMoeda,$DtVencimento, $Valor, $Agencia, $Conta, $NossoNumero7Pos)
{
	$identBanco = '356';
    
	/*$i= 0;
    $ValorMensalidade = RemoveChar($Valor);
    While ($i <= (9-strlen($Valor)))
    {
    	$ValorMensalidade = '0'.$ValorMensalidade;
        $i++;
    }*/
    $ValorMensalidade = FormataValorBoleto($Valor,11);
    
    $DataFator = '03/07/2000';
    $Fator = DiferencaDiasUnibanco($DataFator, $DtVencimento);
    $NumCalDigitao = $NossoNumero7Pos.$Agencia.substr($Conta,1,7);
    $Digitao = CalculaDigitaoBancoReal($NumCalDigitao);
    $NumCalDigVerificador = $identBanco.$CodMoeda.$Fator.$ValorMensalidade.$Agencia.substr($Conta,1,7).$Digitao.'000000'.$NossoNumero7Pos;
    $DigitoVerificador = CalculaDV11($NumCalDigVerificador);
    $CodBarras = $identBanco.$CodMoeda.$DigitoVerificador.$Fator.$ValorMensalidade.$Agencia.substr($Conta,1,7).$Digitao.'000000'.$NossoNumero7Pos;
    return $CodBarras;
}

function GeraNumCodBarrasBancoRural($DtVencimento, $Valor, $Carteira, $NossoNumero, $CodigoAgencia, $NumeroConta, $DigitoConta){
	/*
	 *     A primeira parte do código de barras será calculada automaticamente.
    Ela é composta por:
    Código do banco (3 posições)
    Código da moeda = 9 (1 posição)
     (1 posição) - Será calculado e incluído pelo componente
    Fator de vencimento (4 posições) - Obrigatório a partir de 03/07/2000
    Valor do documento (10 posições) - Sem vírgula decimal e com ZEROS à esquerda

    A segunda parte do código de barras é um campo livre, que varia de acordo
    com o banco. Esse campo livre será calculado por esta função (que você deverá
    alterar de acordo com as informações fornecidas pelo banco).
	 */
	
	//Segunda parte do código de barras - Campo livre - Varia de acordo com o banco
	$ACodigoBanco = '237';
    $ACodigoMoeda = '9';
    $AFatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');
   	//$AValorDocumento = number_format(($Valor*100), 2, '.', '');//Formata o valor com 10 dígitos, incluindo as casas decimais, mas não mostra o ponto decimal
   	$AValorDocumento = FormataValorBoleto($Valor,11);
   	
    $ACarteira      = Formatar($Carteira,2,false,'0');
   	$AAnoAtual      = date("y");
    $ANossoNumero   = substr($NossoNumero,2,11);//Formatar(NossoNumero,11,false,'0');
    $ANossoNumeroDg = CalcularDVNNBancoRural($CodigoAgencia,$NumeroConta,$DigitoConta,$NossoNumero);
    $ACodigoAgencia = Formatar($CodigoAgencia,4,false,'0');
    $ANumeroConta   = Formatar($NumeroConta,7,false,'0');
    $ANumeroContaDg = Formatar($DigitoConta,1,false,'0');
    $ACampoLivre = $ACodigoAgencia . $ACarteira . $ANossoNumero . $ANumeroConta . '0';
    $ACodigoBarras = trim($ACodigoBanco . $ACodigoMoeda . $AFatorVencimento . $AValorDocumento . $ACampoLivre);
    $ADigitoCodigoBarras = Modulo11($ACodigoBarras,9);
    if($ADigitoCodigoBarras == '0')
    	$ADigitoCodigoBarras = '1';
   	return substr($ACodigoBarras,1,4) . $ADigitoCodigoBarras . substr($ACodigoBarras,5,strlen($ACodigoBarras)-4);
}

function GeraNumCodBarrasBNB($Agencia, $DtVencimento, $Valor, $NossoNumero, $DvNossoNumero, $CodigoCedente, $DvCodigoCedente, $Carteira){
	/*
	 * A primeira parte do código de barras será calculada automaticamente.
    Ela é composta por:
    Código do banco (3 posições)
    Código da moeda = 9 (1 posição)
     (1 posição) - Será calculado e incluído pelo componente
    Fator de vencimento (4 posições) - Obrigatório a partir de 03/07/2000
    Valor do documento (10 posições) - Sem vírgula decimal e com ZEROS à esquerda

    A segunda parte do código de barras é um campo livre, que varia de acordo
    com o banco. Esse campo livre será calculado por esta função (que você deverá
    alterar de acordo com as informações fornecidas pelo banco).
	 */
	
	// Segunda parte do código de barras - Campo livre - Varia de acordo com o banco
	$CodigoBanco = '004';
    $CodigoMoeda = '9';
    $FatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');
    //$ValorDocumento = number_format(($Valor*100), 2, '.', ''); //Formata o valor com 10 dígitos, incluindo as casas decimais, mas não mostra o ponto decimal
    $ValorDocumento = FormataValorBoleto($Valor,11);
    
    $ICampoLivre = $Agencia.$CodigoCedente.$DvCodigoCedente.$NossoNumero.$DvNossoNumero.$Carteira.'000';
   	$CampoLivre = $ICampoLivre; //+DvCampoLivre;
    $ICodigoBarras = $CodigoBanco.$CodigoMoeda.$FatorVencimento.$ValorDocumento.$CampoLivre;
    $DigitoCodigoBarras = Modulo11($ICodigoBarras,9);
    if($DigitoCodigoBarras == '0')
        $DigitoCodigoBarras = '1';

   	return substr($ICodigoBarras,0,4).$DigitoCodigoBarras.substr($ICodigoBarras,4,strlen($ICodigoBarras)-4);
}


function GeraNumCodBarrasBancoBradesco($DtVencimento, $Valor, $Carteira, $NossoNumero, $CodigoAgencia, $NumeroConta, $DigitoConta){
	/*
	 *     A primeira parte do código de barras será calculada automaticamente.
    Ela é composta por:
    Código do banco (3 posições)
    Código da moeda = 9 (1 posição)
     (1 posição) - Será calculado e incluído pelo componente
    Fator de vencimento (4 posições) - Obrigatório a partir de 03/07/2000
    Valor do documento (10 posições) - Sem vírgula decimal e com ZEROS à esquerda

    A segunda parte do código de barras é um campo livre, que varia de acordo
    com o banco. Esse campo livre será calculado por esta função (que você deverá
    alterar de acordo com as informações fornecidas pelo banco).
	 */

	// Segunda parte do código de barras - Campo livre - Varia de acordo com o banco
	$ACodigoBanco = '237';
    $ACodigoMoeda = '9';
    $AFatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');
    $AValorDocumento = FormataValorBoleto($Valor, 11);
    $ACarteira      = Formatar($Carteira,2,false,'0');
    $AAnoAtual      = date("y");
    $ANossoNumero   = substr($NossoNumero,2,11);//Formatar(NossoNumero,11,false,'0');
    $ANossoNumeroDg = CalcularDVNNBradesco($CodigoAgencia,$NumeroConta,$DigitoConta,$NossoNumero);
    $ACodigoAgencia = Formatar($CodigoAgencia,4,false,'0');
    $ANumeroConta   = Formatar($NumeroConta,7,false,'0');
    $ANumeroContaDg = Formatar($DigitoConta,1,false,'0');
    $ACampoLivre    = $ACodigoAgencia . $ACarteira . $ANossoNumero . $ANumeroConta . '0';
    $ACodigoBarras  = trim($ACodigoBanco . $ACodigoMoeda . $AFatorVencimento . $AValorDocumento . $ACampoLivre);
    $ADigitoCodigoBarras = Modulo11($ACodigoBarras,9);

    if($ADigitoCodigoBarras == '0')
        $ADigitoCodigoBarras = '1';

    return substr($ACodigoBarras,0,4) . $ADigitoCodigoBarras . substr($ACodigoBarras,4,strlen($ACodigoBarras)-4);
}


function GeraNumCodBarrasITAU($Agencia, $DtVencimento, $Valor, $NossoNumero, $Conta, $Carteira){
	//01 a 03 Código do Banco na Câmara de Compensação = '341'
    $CodigoBanco = '341';
    
    //4 A 4 CODIGO DA MOEDA 9
    $CodigoMoeda = '9';

   	//5 A 5 DIGITO MODULO 11
    //MAIS NA FRENTE

   	//6 A 9 FATOR DE VENCIMENTO
    $FatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');

    //10 A 19 VALOR
    $ValorDocumento = FormataValorBoleto($Valor,11);//number_format($Valor*100, 2, '.', ''); // Formata o valor com 10 dígitos, incluindo as casas decimais, mas não mostra o ponto decimal

    //20 A 22 CARTEIRA
    $ICampoLivre = $Carteira;
    
    //23 A 30 NOSSONUMERO
    $ICampoLivre = $ICampoLivre.''.$NossoNumero;

    //31 A 31 DAC - 126 - 131 - 146 - 150 e 168 - CARTEIRA / NOSSONUMERO
    //31 A 31 DAC OUTROS - AGÊNCIA / CONTA (sem DAC) / CARTEIRA / NOSSO NÚMERO
    $ICampoLivre = $ICampoLivre.''.DAC10($Agencia.''.$Conta.''.$Carteira.''.$NossoNumero);

    //32 A 35 AGENCIA
    $ICampoLivre = $ICampoLivre.''.$Agencia;

    //36 A 40 CONTA
    $ICampoLivre = $ICampoLivre.''.$Conta;

    //41 A 41 DAC AGENCIA/CONTA
    $ICampoLivre = $ICampoLivre.''.DAC10($Agencia.''.$Conta);

    //42 A 44 ZEROS
    $ICampoLivre = $ICampoLivre .''.'000';

    //ICampoLivre:=Agencia+CodigoCedente+DvCodigoCedente+NossoNumero+DvNossoNumero+Carteira+'000';
    $CampoLivre = $ICampoLivre;//+DvCampoLivre;
    $ICodigoBarras = $CodigoBanco.''.$CodigoMoeda.''.$FatorVencimento.''.$ValorDocumento.''.$CampoLivre;
    $DigitoCodigoBarras = Modulo11itau($ICodigoBarras,9);
    return substr($ICodigoBarras,0,4).''.$DigitoCodigoBarras.''.substr($ICodigoBarras,4,strlen($ICodigoBarras)-4);

}

function GeraNumCodBarrasSANTANDER($Agencia, $DtVencimento, $Valor, $NossoNumero, $Conta, $Carteira){
	//01 a 03 Código do Banco na Câmara de Compensação = '341'
	$CodigoBanco = '033';

    //4 A 4 CODIGO DA MOEDA 9
    $CodigoMoeda = '9';

    //5 A 5 DIGITO MODULO 11
    //MAIS NA FRENTE

    //6 A 9 FATOR DE VENCIMENTO
    $FatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');

    //10 A 19 VALOR
    $ValorDocumento = FormataValorBoleto($Valor,11);//number_format($Valor*100, 2, '.', ''); // Formata o valor com 10 dígitos, incluindo as casas decimais, mas não mostra o ponto decimal

    //20 A 22 VALOR 9
    $ICampoLivre = '9';

    //21 a 27 COD. CEDENTE
    $ICampoLivre = $ICampoLivre . $Conta;

    //28 A 40 NOSSONUMERO
    $ICampoLivre = $ICampoLivre.Formatar($NossoNumero,13,false,'0');

    //41 a 41 imposto segurado - valor 0
    $ICampoLivre = $ICampoLivre.'0';

   	//42 A 44 CARTEIRA
    //$ICampoLivre = $ICampoLivre.$Carteira; //alterado por causa da modalidade de carteira
    $ICampoLivre = $ICampoLivre.'101'; //101-Cobrança Simples Rápida COM Registro

    $CampoLivre = $ICampoLivre;//+DvCampoLivre;
    $ICodigoBarras = $CodigoBanco.$CodigoMoeda.$FatorVencimento.$ValorDocumento.$CampoLivre;
   	$DigitoCodigoBarras = Modulo11SANTANTER('codbarras',$ICodigoBarras,9);

   	return substr($ICodigoBarras,0,4).$DigitoCodigoBarras.substr($ICodigoBarras,4,strlen($ICodigoBarras)-4);
}

function GeraNumCodBarrasBancoBIC($DtVencimento, $Valor, $Carteira, $NossoNumero, $CodigoAgencia, $NumeroConta, $Radical, $cliente_idBanco){
	/*
	 * A primeira parte do código de barras será calculada automaticamente.
    Ela é composta por:
    Código do banco (3 posições)
    Código da moeda = 9 (1 posição)
     (1 posição) - Será calculado e incluído pelo componente
    Fator de vencimento (4 posições) - Obrigatório a partir de 03/07/2000
    Valor do documento (10 posições) - Sem vírgula decimal e com ZEROS à esquerda

    A segunda parte do código de barras é um campo livre, que varia de acordo
    com o banco. Esse campo livre será calculado por esta função (que você deverá
    alterar de acordo com as informações fornecidas pelo banco).
	 */
	
	// Segunda parte do código de barras - Campo livre - Varia de acordo com o banco
	$ACodigoBanco = '237';
    $ACodigoMoeda = '9';
    $AFatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');
   	//$AValorDocumento = number_format($Valor*100, 2, '.', ''); // Formata o valor com 10 dígitos, incluindo as casas decimais, mas não mostra o ponto decimal
   	$AValorDocumento = FormataValorBoleto($Valor,11);
   	
    $ACarteira      = Formatar($Carteira,2,false,'0');
    $AAnoAtual      = date("y");
   	$ANossoNumero   = substr($NossoNumero,7,6);
    $ACodigoAgencia = Formatar($CodigoAgencia,4,false,'0');
    $ANumeroConta   = Formatar($NumeroConta,7,false,'0');
    $ARadical       = Formatar($Radical,2,false,'0');
    $AMatriculaBanco = Formatar($cliente_idBanco,3,false,'0');
    //ACampoLivre    := Formatar(ACodigoAgencia + ACarteira+ANossoNumero+ANumeroConta+'0',25,false,'0');
    $ACampoLivre    = Formatar($ACodigoAgencia.$ACarteira.$ARadical.$AMatriculaBanco.$ANossoNumero.$ANumeroConta.'0',25,false,'0');
   	$ACodigoBarras  = trim($ACodigoBanco . $ACodigoMoeda . $AFatorVencimento . $AValorDocumento . $ACampoLivre);
    $ADigitoCodigoBarras = Modulo11Bic($ACodigoBarras,9);
    if(($ADigitoCodigoBarras == '0') or ($ADigitoCodigoBarras == '1'))
    	$ADigitoCodigoBarras = '1';
        
   	return substr($ACodigoBarras,0,4) . $ADigitoCodigoBarras . substr($ACodigoBarras,4,strlen($ACodigoBarras)-4);
}

function GeraNumCodBarrasHSBC($Agencia, $DtVencimento, $Valor, $NossoNumero, $Conta, $Carteira){
	//01 a 03 Código do Banco na Câmara de Compensação = '399'
    $CodigoBanco = '399';

   	//4 A 4 CODIGO DA MOEDA 9
    $CodigoMoeda = '9';

    //5 A 5 DIGITO MODULO 11
    //MAIS NA FRENTE

   	//6 A 9 FATOR DE VENCIMENTO
    $FatorVencimento = Formatar(CalcularFatorVencimento($DtVencimento),4,false,'0');

    //10 A 19 VALOR
    //$ValorDocumento = number_format($Valor*100, 2, '.', ''); // Formata o valor com 10 dígitos, incluindo as casas decimais, mas não mostra o ponto decimal
    $ValorDocumento = FormataValorBoleto($Valor,11);

    $ICampoLivre = '';
    //20 A 30 NOSSONUMERO
    $ICampoLivre = $ICampoLivre.Formatar($NossoNumero,11,false,'0');;

    //31 a 41 COD. CEDENTE
    $ICampoLivre = $ICampoLivre . $Agencia . $Conta;

    //42 A 43 CARTEIRA
    //$ICampoLivre = $ICampoLivre.$Carteira;//alterado por Charles pois algumas carteiras sao string
    $ICampoLivre = $ICampoLivre.'00';

    //44 A 44 Codigo Cob
    $ICampoLivre = $ICampoLivre.'1';

    $CampoLivre = $ICampoLivre;
    $ICodigoBarras = $CodigoBanco.$CodigoMoeda.$FatorVencimento.$ValorDocumento.$CampoLivre;
    $DigitoCodigoBarras = Modulo11HSBC('codbarras',$ICodigoBarras,9);

   	return substr($ICodigoBarras,0,4).$DigitoCodigoBarras.substr($ICodigoBarras,4,strlen($ICodigoBarras)-4);
}

/*
function CalculaDigitaoBancoReal($numero_base)
{
	$tamanho_num = strlen($numero_base);
    $peso = 2;
    $somafinal = 0;
    for ($i==($tamanho_num-1); $i>=0; $i--)
    {
	    //----------------------------
	    	$j=0;
	        $soma = (($numero_base[$i]) * $peso);
	        $q = $soma;
	
	    //------Teste para ver se o resultado foram dois numeros
	     if (strlen($Soma) == 2)
	     {
	         $x = substr($q,1,1);
	         $j = substr($q,2,1);
	         $soma = $x + $j;
	           
	     }
	       
		//---Variação do Peso: 2 ou 1
		if($peso == 2)
	    {
	    	$peso = 1;
	        }
	        else
	        {
	            $peso = $peso + 1;
	        }
	    //---Totalização do resultado final
	    $somafinal = $somafinal + $soma;
    }
    $resto = $somafinal % 10;
    $resto = 10 - $resto;
    if ($resto == 10)
    {
         $CalculaDigitaoBancoReal = 0;
    }
    else
    {
        $CalculaDigitaoBancoReal = $resto;  
    }
	return $CalculaDigitaoBancoReal;
}*/

function CalculaDigitaoBancoReal($numero_base)
{

    $tamanho_num = strlen($numero_base);
    $peso = 2;
    $somafinal = 0;

    $valor = str_split($numero_base);
    for ($i = $tamanho_num - 1; $i >= 0; $i--)
    {

        //---------------------------
        $j = 0;
        $soma = $valor[$i] * $peso;
        $q = $soma;

        //------Teste para ver se o resultado foram dois numeros
        if (strlen($soma) == 2)
        {
            $x = substr($q,0,1);
            $j = substr($q,1,1);
            $soma = $x + $j;
        }

        //---Variação do Peso: 2 ou 1
        if ($peso == 2) $peso = 1;
        else  $peso = $peso + 1;

        //---Totalização do resultado final
        $somafinal = $somafinal + $soma;
    }

    $resto = $somafinal % 10;

    $resto = 10 - $resto;

    if ($resto == 10) $CalculaDigitaoBancoReal = 0;
    else  $CalculaDigitaoBancoReal = $resto;

    return $CalculaDigitaoBancoReal;
}

function CalcularDVNNBancoRural($CodigoAgencia, $NumeroConta, $DigitoConta, $NossoNumero){
	$result = '0';
	
	$ACodigoAgencia = Formatar($CodigoAgencia,4,false,'0');
   	$ANumeroConta   = Formatar($NumeroConta,9,false,'0');
   	$ADigitoConta   = Formatar($DigitoConta,1,false,'0');
   	$ANossoNumero   = Formatar($NossoNumero,8,false,'0');
   	$ANossoNumero   = $ANossoNumero[1].$ANossoNumero[2].$ANossoNumero[3].$ANossoNumero[4].$ANossoNumero[5].$ANossoNumero[6].$ANossoNumero[7]; 
   	$AComposicao    = $ACodigoAgencia . $ANumeroConta . $ADigitoConta . $ANossoNumero;
   	
   	/*
   	 * Multiplicar os algarismos da composição, iniciando da direita para a esquerda
    pelos pesos: 3, 7, 9, 1, com exceção do campo "Dígito da Conta", que deve ser
    multiplicado sempre por 1
   	 */
   	
   	$APesos = '31973197319731319731973';
   	$ASoma = 0;
   	for($AContador = 0; $AContador < strlen($AComposicao); $AContador++){
   		$ASoma = $ASoma + ( ((int)$AComposicao[$AContador]) * ((int)$APesos[$AContador]) );
   	}
   	
   	$AResto = ($ASoma % 10);
   	if($AResto == 0)
    	$result = '0';
   	else
    	$result = 10 - $AResto;
    	
    return $result;
}

function CalcularDVNNBradesco($CodigoAgencia, $NumeroConta, $DigitoConta, $NossoNumero){
	$result = 0;
	
	$ACodigoAgencia = Formatar($CodigoAgencia,4,false,'0');
   	$ANumeroConta   = Formatar($NumeroConta,9,false,'0');
   	$ADigitoConta   = Formatar($DigitoConta,1,false,'0');
   	$ANossoNumero   = Formatar($NossoNumero,8,false,'0');
   	$ANossoNumero   = $ANossoNumero[1].$ANossoNumero[2].$ANossoNumero[3].$ANossoNumero[4].$ANossoNumero[5].$ANossoNumero[6].$ANossoNumero[7];
   	$AComposicao    = $ACodigoAgencia . $ANumeroConta . $ADigitoConta . $ANossoNumero;
   	
   	/*
   	 * Multiplicar os algarismos da composição, iniciando da direita para a esquerda
    pelos pesos: 3, 7, 9, 1, com exceção do campo "Dígito da Conta", que deve ser
    multiplicado sempre por 1
   	 */
   	//APesos := '31973197319731319731973';
   	$APesos = '4329876543298765432987654329876543298765432';
   	
   	$ASoma = 0;
   	for($AContador = 0; $AContador < strlen($AComposicao); $AContador++){
   		$ASoma = $ASoma + ( (int)$AComposicao[$AContador] * (int)$APesos[$AContador]);	
   	}
   	
   	$AResto = ($ASoma % 11);
   	if(($AResto == 0)or($AResto == 10)or($AResto == 1))
      $result = '1';
   	else
      $result = 11 - $AResto;
      
    return $result;
}

function DiferencaDias($dataVenc,$dataAtual)
{
	/*Var Data: TDateTime;
	dia, mes, ano: Word;
	begin*/
	$data1=explode("/", $dataVenc);
	$dataVenc2=$data1[2]."-".$data1[1]."-".$data1[0];
	
	$data1=explode("/", $dataAtual);
	$dataAtual2=$data1[2]."-".$data1[1]."-".$data1[0];
	
	if (strtotime($dataAtual2) < strtotime($dataVenc2))
	{
		return 'A data data atual não pode ser menor que a data inicial';
	}
	else
	{
		
        $data = diffDate($dataVenc,$dataAtual);	
		//$data = $dataAtual - $dataVenc;
		return $data;
	}
}

function DiferencaDiasUnibanco($DataVenc, $DataAtual){
	$data1=explode("/", $DataVenc);
	$dataVenc2=$data1[2]."-".$data1[1]."-".$data1[0];
	
	$data1=explode("/", $DataAtual);
	$dataAtual2=$data1[2]."-".$data1[1]."-".$data1[0];
	
	if(strtotime($dataAtual2) < strtotime($dataVenc2)){
		$result = 'A data data atual não pode ser menor que a data inicial';
	}
	else{
		$Data = (int)diffDate($dataAtual2, $dataVenc2, 'D') + 1000;
		$result = $Data;
	}
	return $result;
}

function diffDate($dataVenc,$dataAtual)
{
	/*
        parametros antigos diffDate($d1, $d2, $type='', $sep='-');
        
        ###função alterada devido problemas na diferenca de datas
    
        
        $d1 = explode($sep, $d1);
        $d2 = explode($sep, $d2);
        switch ($type)
        {
        	case 'A':
        		$X = 31536000;
        		break;
        	case 'M':
        		$X = 2592000;
        		break;
        	case 'D':
        		$X = 86400;
        		break;
        	case 'H':
        		$X = 3600;
        		break;
        	case 'MI':
        		$X = 60;
        		break;
        	default:
        		$X = 1;
        }
        return floor(((mktime(0,0,0,$d2[1],$d2[0],$d2[2])-mktime(0,0,0,$d1[1],$d1[0],$d1[2]))/$X));	

    */
   	global $DB;
    
    list($day, $month, $year) = split('[/.-]', $dataAtual);

    $year = trim($year);
    $month = trim($month);
    $day = trim($day);

    $month = strlen($month) == 2 ? $month : '0'.$month;
    $day = strlen($day) == 2 ? $day : '0'.$day;

	$dataAtual2 = $year."-".$month."-".$day;
	
	list($day, $month, $year) = split('[/.-]', $dataVenc);

    $year = trim($year);
    $month = trim($month);
    $day = trim($day);

    $month = strlen($month) == 2 ? $month : '0'.$month;
    $day = strlen($day) == 2 ? $day : '0'.$day;

	$dataVenc2 = $year."-".$month."-".$day;
	
 
	//O fator de vencimento é a quantidade de dias entre 07/Nov/1997 e a data de vencimento do título
	$sql = "Select DATEDIFF('$dataVenc2', '$dataAtual2') as diferenca";
	$rs = $DB->Execute($sql);  	
	$Diferenca = $rs->fields['diferenca'] * (-1); //tratamento para a função do mysql
	return $Diferenca;
}

function DAC10($Numero){
	$Numero = trim($Numero);
  	$Digito = 0;
  	$j = 2;	
  	
  	for($i = (strlen($Numero)-1); $i >= 0; $i--){
  		$N = (int)($Numero[$i]);
     	$cod = $N*$j;
     	if($cod >= 10)
     		$cod = ($cod % 10)+ floor($cod / 10);

     	$Digito = $Digito + $cod;
     	if($j == 2)
       		$j = 1;
     	else
       		$j = 2;
  	}
  	$Digito = $Digito % 10;
    if($Digito != 0){
	    if(10-$Digito == '10')
	      $result = '0';
	    else
	      $result = 10-$Digito;
  	}
	else{
		$result = '0';
	}
	return $result;
}

function Formatar($Texto, $TamanhoDesejado,$AcrescentarADireita,$CaracterAcrescentar = ' ')
{
	/*
	OBJETIVO: Eliminar caracteres inválidos e acrescentar caracteres à esquerda ou à direita do texto original para que a string resultante fique com o tamanho desejado
	
	Texto : Texto original
	TamanhoDesejado: Tamanho que a string resultante deverá ter
	AcrescentarADireita: Indica se o carácter será acrescentado à direita ou à esquerda
	  TRUE - Se o tamanho do texto for MENOR que o desejado, acrescentar carácter à direita
	         Se o tamanho do texto for MAIOR que o desejado, eliminar últimos caracteres do texto
	  FALSE - Se o tamanho do texto for MENOR que o desejado, acrescentar carácter à esquerda
	         Se o tamanho do texto for MAIOR que o desejado, eliminar primeiros caracteres do texto
	CaracterAcrescentar: Carácter que deverá ser acrescentado
	
	
	switch($CaracterAcrescentar)
	{
	case 1:
	'0'..'9','a'..'z','A'..'Z'  ;
	}
	*/
	
	
	$Texto = trim(strtoupper($Texto)); //  Strtoupper = faz um upper em caracteres especiais
	$TamanhoTexto = strlen($Texto);  //stlen - retorna o tamanho da sgtring
	$TodosCaracteres = ('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ`~\'\'\"!@#$%^&*()_-+=|/\{}[]:;,.<>');
	for ($i=0;$i<$TamanhoTexto;$i++)
	{
		//pos - vasculha uma string e retorna um inteiro 
		if (strpos($Texto[$i],$TodosCaracteres)== 0)
		{
		      
		 switch($Texto[$i])
		 {
		    case ("'Á','À','Â','Ä','Ã'"):
			    $Texto[$i] = 'A';
			    break;
		    case ("'É','È','Ê','Ë'"):
			    $Texto[$i] = 'E';
			    break;
		    case ("'Í','Ì','Î','Ï'"):
			    $Texto[$i] = 'I';
			    break;
		    case ("'Ó','Ò','Ô','Ö','Õ'"):
			    $Texto[$i] = 'O';
			    break;
		    case ("'Ú','Ù','Û','Ü'"):
			    $Texto[$i] = 'U';
			    break;
		    case 'Ç':
			    $Texto[$i] = 'C';
			    break;
		    case 'Ñ':
			    $Texto[$i] = 'N';
			    break;
//		    default:
//		    	$Texto[$i] = '';
		 }
		}
	}  //
	
	$QuantidadeAcrescentar = $TamanhoDesejado - $TamanhoTexto;
	if ($QuantidadeAcrescentar < 0){
		$QuantidadeAcrescentar = 0;
	} 
	if ($CaracterAcrescentar == ''){
		$CaracterAcrescentar = ' ';
	}
	if ($TamanhoTexto >= $TamanhoDesejado){
		$PosicaoInicial = ($TamanhoTexto - $TamanhoDesejado + 1);
	}
	else{
		$PosicaoInicial = 1;
	}
	if ($AcrescentarADireita){
		$Texto = substr($Texto,0,$TamanhoDesejado).str_repeat($CaracterAcrescentar,$QuantidadeAcrescentar);
	}		
	else
		$Texto = str_repeat($CaracterAcrescentar,$QuantidadeAcrescentar).substr($Texto,$PosicaoInicial-1,$TamanhoDesejado);

	return strtoupper($Texto);
}

function CalcularFatorVencimento($DataDesejada)
{	
	global $DB;
	list($day, $month, $year) = split('[/.-]', $DataDesejada);

    $year = trim($year);
    $month = trim($month);
    $day = trim($day);

    $month = strlen($month) == 2 ? $month : '0'.$month;
    $day = strlen($day) == 2 ? $day : '0'.$day;

	$DataDesejada = "$year-$month-$day";
	//O fator de vencimento é a quantidade de dias entre 07/Nov/1997 e a data de vencimento do título
	$sql = "Select DATEDIFF('1997-10-07', '".$DataDesejada."') as diferenca";
	$rs = $DB->Execute($sql);  	
	$Diferenca = $rs->fields['diferenca'];
	return $Diferenca;
}


function Modulo11Itau($Valor, $Base = 9, $Resto = false){
	/*
	 * Rotina muito usada para calcular dígitos verificadores
   Pega-se cada um dos dígitos contidos no parâmetro VALOR, da direita para a
   esquerda e multiplica-se pela seqüência de pesos 2, 3, 4 ... até BASE.
   Por exemplo: se a base for 9, os pesos serão 2,3,4,5,6,7,8,9,2,3,4,5...
   Se a base for 7, os pesos serão 2,3,4,5,6,7,2,3,4...
   Soma-se cada um dos subprodutos.
   Divide-se a soma por 11.
   Faz-se a operação 11-Resto da divisão e devolve-se o resultado dessa operação
   como resultado da função Modulo11.
   Obs.: Caso o resultado seja
       maior que 9, deverá ser substituído por 0 (ZERO).
	 */
	$Soma = 0;
   	$Peso = 2;
   	for($Contador = (strlen($Valor)-1); $Contador >= 0; $Contador--){
   		$Soma = $Soma + ((int)$Valor[$Contador] * $Peso);
      	if($Peso < $Base)
        	$Peso = $Peso + 1;
      	else
         	$Peso = 2;
   	}
   	
   	if($Resto)
      $result = $Soma % 11;
   else{
      $Digito = 11 - ($Soma % 11);
      if(($Digito == 0)or($Digito == 1)or($Digito>9))
         $Digito = 1;
      $result = $Digito;
   }
   return $result;
}

function Modulo11Bic($Valor, $Base = 9, $Resto = false){
	/*
	 * Rotina muito usada para calcular dígitos verificadores
   Pega-se cada um dos dígitos contidos no parâmetro VALOR, da direita para a
   esquerda e multiplica-se pela seqüência de pesos 2, 3, 4 ... até BASE.
   Por exemplo: se a base for 9, os pesos serão 2,3,4,5,6,7,8,9,2,3,4,5...
   Se a base for 7, os pesos serão 2,3,4,5,6,7,2,3,4...
   Soma-se cada um dos subprodutos.
   Divide-se a soma por 11.
   Faz-se a operação 11-Resto da divisão e devolve-se o resultado dessa operação
   como resultado da função Modulo11.
   Obs.: Caso o resultado seja
       maior que 9, deverá ser substituído por 0 (ZERO).
	 */
	$Soma = 0;
   	$Peso = 2;
   	for($Contador = (strlen($Valor)-1); $Contador >= 0; $Contador--){
   		$Soma = $Soma + ((int)$Valor[$Contador] * $Peso);
   		if($Peso < $Base)
        	$Peso = $Peso + 1;
      	else
         	$Peso = 2;
   	}
   	
   	if($Resto)
   		$result = $Soma % 11;
   	else{
   		$Digito = 11 - ($Soma % 11);
      	if(($Digito > 9)or($Digito == 0)or($Digito == 1))
        	$Digito = 1;
        
      	$result = $Digito;
   	}
   	return $result;
}

function RemoveChar($texto)
{
	//
	// Remove caracteres de uma string deixando apenas numeros
	//
	/*$S = '';
	for ($i == 0; $i<=strlen($texto);$i++)
	{
	    
	    $res = preg_match('/([-.0-9]{1,30})/', $texto[i]);
	
	    if ($res)
	    {
	        $S = $S + substr($Texto, $I-1, 1);
	        
	    }
	}*/
	$S = $texto;
	$S = str_replace('.','',$S);
	$S = str_replace(',','',$S);
    $S = str_replace('-','',$S);
	
	return $S;
}

function CalculaDV11($numero_base)
{
	/*
	{------------------------------------------------------------------------------}
	{ function do Calculo de DV Módulo 11 }
	{------------------------------------------------------------------------------}
	{ Objetivo:
	Esta function tem a finalidade de calcular um DV módulo 11.	
	Entrada: string com valores numéricos. Deve ser informado
	obrigatoriamente um valor numérico convertido p/ string.	
	Saída: byte de uma posiçao contendo o DV calculado.
	}*/
	
	$tamanho_num = strlen($numero_base);
	$peso = 2;
	$soma = 0;
	$vetor = str_split($numero_base);
	//for i := (tamanho_num) downto 1 do
	for ($i=$tamanho_num;$i>=1;$i--)
	{
		$soma = $soma + ($vetor[$i-1] * $peso);
		if ($peso == 9)
			$peso = 2;
		else
			$peso = $peso + 1;
	}
	$resto = $soma % 11;
	$resto = 11 - $resto;
	if (($resto == 0) || ($resto == 1) || ($resto > 9))
		return 1;
	else
		return $resto;
}

function GeraNossoNumero($cliente_id, $Parcela, $Ano, $Sequencial, $TipoBanco, $Carteira){
	global $DB;
    
    $idBanco = $TipoBanco;
	$sql = "select sigla, cod_cliente, substring(num_convenio,1,7) as convenio from bancos where id='".$TipoBanco."'";
	
	$ds = $DB->Execute($sql);	
	$Sigla = trim($ds->fields['sigla']);
	$CodCliente = trim($ds->fields['cod_cliente']);
    $convenio = trim($ds->fields['convenio']);
	
	$result = '0';

	if($Sigla == 'CS')
		$result = NossoNumero($cliente_id, $Parcela, substr($Ano,2,2),$Sequencial);
	
	if($Sigla == 'CR')
    	$result = NossoNumero11Pos($cliente_id, $Parcela, substr($Ano,2,2),$Sequencial);

  	if($Sigla == 'US')
    	$result = NossoNumero14Pos($cliente_id, $Parcela, substr($Ano,2,2),$Sequencial);

  	if($Sigla == 'BB')
    	$result = NossoNumero18PosBB($cliente_id, $Parcela, substr($Ano,2,2),$Sequencial,$convenio);
    	
    if($Sigla == 'PC')
        $result = GeraNossoNumeroPagContas(); //pag contas

    if($Sigla == 'RC')
    	$result = NossoNumero7Pos();

	if($Sigla == 'RS')
		$result = NossoNumero13PosBR($cliente_id, $Parcela, substr($Ano,2,2),$Sequencial);
	
	if($Sigla == 'RU')
		$result = NossoNumero13PosBD($Parcela, substr($Ano,2,2),$Sequencial,'19');
	
	if($Sigla == 'SR')
        $result = NossoNumero15PosSIGCB($Carteira);
		
	if($Sigla == 'BN')
      	$result = NossoNumero7Pos();

  	if($Sigla == 'BR')
      	//$result = NossoNumero13PosBRAD($Parcela, substr($Ano,2,2),$Sequencial,'06');
  		$result = NossoNumero13PosBRAD($Parcela, substr($Ano,2,2),$Sequencial,$Carteira);

  	if($Sigla == 'IT')
    	$result = NossoNumeroITAU();

  	if($Sigla == 'BS')
    	$result = NossoNumeroSANTANDER();

  	if($Sigla == 'BI')
    	$result = NossoNumero6PosBIC($Carteira);
    	
    if($Sigla == 'HS')
    	$result = NossonumeroHSBC($CodCliente);

    return $result;	
}

function GeraNossoNumeroPagContas()
{
    global $DB;

    $sql = "Select (MAX(CAST(SUBSTRING(nosso_numero,1,(LENGTH(nosso_numero)-2)) AS UNSIGNED)))+1 as nosso_numero from parcelas where SUBSTRING(nosso_numero,(LENGTH(nosso_numero)-1), LENGTH(nosso_numero)) = 'PC' ";

    $rs = $DB->Execute($sql);

    $NossoNumeroPC = trim($rs->fields['nosso_numero']);

    if ($NossoNumeroPC == '')    $NossoNumeroPC = '1PC';
    else  $NossoNumeroPC = $NossoNumeroPC.'PC';


    return Completa($NossoNumeroPC,'NI',13);
}


function NossoNumero($cliente_id, $Mes, $Ano, $Sequencial){
	$i = 0;
	$NossoNum = '92';
   	$NossoNum = $NossoNum . $cliente_id;

   	While ($i <= (1-strlen($Mes))){
   		$NossoNum = $NossoNum . '0';
   		$i++;
   	}
	$NossoNum = $NossoNum . $Mes;
   	$NossoNum = $NossoNum . $Ano;
   	
   	if(strlen($Sequencial) >= 2)
   		$NossoNum = $NossoNum . substr($Sequencial,1,1);
   	else
   		$NossoNum = $NossoNum . $Sequencial;
   		
   	$NossoNum = $NossoNum . CalculaDV11NN($NossoNum);
   	return $NossoNum;
}

function NossoNumero11Pos($cliente_id, $Mes, $Ano, $Sequencial){
	global $DB;
	$i= 0;
   	$NossoNum = '9';

    $NossoNum = $NossoNum . '00';
   	$NossoNum = $NossoNum . $Ano;
   	$i = 0;
   	$ds = $DB->Execute("Select Max(nosso_numero) as max from parcelas where substring(nosso_numero,1,5) = '".$NossoNum."'");
   	if($ds->fields['max'] == '')
   		$NossoNum = $NossoNum . '00001';
   	else{
   		$Valor = (int)substr($ds->fields['max'],5,5) + 1;
   		while($i <= (4-strlen((string)$Valor))){
   			$NossoNum = $NossoNum . '0';
         	$i++;
   		}
   		$NossoNum = $NossoNum . (string)$Valor;
   	}
   	
   	$NossoNum = $NossoNum . (string)(CalculaDV11NN($NossoNum));
   	return $NossoNum;
}

function NossoNumero14Pos($cliente_id, $Mes, $Ano, $Sequencial){
	$i = 0;
	$NossoNum = '5';
	$NossoNum = $NossoNum . $cliente_id;
	
	While($i <= (1-strlen($Mes))){
		$NossoNum = $NossoNum . '0';
     	$i++;
	}
	
	$NossoNum = $NossoNum . $Mes;
   	$NossoNum = $NossoNum . $Ano;
   	
   	if(strlen($Sequencial) >= 2)
   		$NossoNum = $NossoNum . substr($Sequencial,1,1);
   	else
   		$NossoNum = $NossoNum . $Sequencial;
   		
   	$NossoNum = $NossoNum . CalculaDV11NN($NossoNum);
   	return $NossoNum;
}

function NossoNumero18PosBB($cliente_id, $Mes, $Ano, $Sequencial, $convenio){
	global $DB;

	$i = 0;
	
	//Recebimento do Numero do convênio(inicio do nosso numero)
	$NossoNum = $convenio;
	//NossoNumero + Sequencial do boleto
	if(strlen($Sequencial) >= 2)
		$NossoNum = $NossoNum . '0' . substr($Sequencial,1,1);
	else
		$NossoNum = $NossoNum . '0' . $Sequencial;
		
	$NossoNum = $NossoNum . $Ano;
	
	$i = 0;
	
	$ds = $DB->Execute("Select Max(nosso_numero) as nossonumero from parcelas where substring(nosso_numero,1,11)= '".$NossoNum."' and LENGTH(nosso_numero)=18");
	if($ds->fields['nossonumero'] == ''){
		$NossoNum = $NossoNum . '000001';
	}
	else{
		$valor = (int)substr($ds->fields['nossonumero'],11,6) + 1;
		while($i <= (5-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
		$NossoNum = $NossoNum . $valor;
	}
	
	$NossoNum = $NossoNum . (string)(CalculaDV11NN($NossoNum));
	return $NossoNum;
}

function NossoNumero7pos(){
	global $DB;
	
	$i = 0;
	$ds1 = $DB->Execute("Select Max(nosso_numero) as nosso_numero from parcelas where LENGTH(nosso_numero) = '7' and not (nosso_numero like '%A%' or nosso_numero like '%B%' or
    	nosso_numero like '%C%' or nosso_numero like '%D%' or nosso_numero like '%E%' or nosso_numero like '%F%' or nosso_numero like '%G%' or
      	nosso_numero like '%H%' or nosso_numero like '%I%' or nosso_numero like '%J%' or nosso_numero like '%L%' or nosso_numero like '%M%' or
    	nosso_numero like '%N%' or nosso_numero like '%O%' or nosso_numero like '%P%' or nosso_numero like '%Q%' or nosso_numero like '%R%' or
    	nosso_numero like '%S%' or nosso_numero like '%T%' or nosso_numero like '%U%' or nosso_numero like '%V%' or nosso_numero like '%X%' or
    	nosso_numero like '%Z%' or nosso_numero like '%-%')");
	
	$mensalidades = trim($ds1->fields['nosso_numero']);

	if($mensalidades == ''){
		$NossoNum = '0000001';
	}
	else{
		$valor = (int)$mensalidades + 1;

        $NossoNum = '';
		While($i <= (6-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
         	$i++;
		}
        $NossoNum = $NossoNum . $valor;
	}
	
	return $NossoNum;
}

function NossoNumero13PosBR($cliente_id, $Mes, $Ano, $Sequencial){
	global $DB;
	
	$i = 0;
	$NossoNum = '000';

    $NossoNum = $NossoNum . '00';
	$NossoNum = $NossoNum . $Ano;
	$NossoNum = $NossoNum . substr($cliente_id,3,2);
	
	$i = 0;
	$ds = $DB->Execute("Select Max(nosso_numero) as nosso_numero from parcelas where substring(nosso_numero,1,9) = '".$NossoNum."'");
	
	if($ds->fields['nosso_numero'] == ''){
		$NossoNum = $NossoNum . '001';
	}
	else{
		$valor = ((int)substr((string)$ds->fields['nosso_numero'],9,3)) + 1;
		while($i <= (2-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
		$NossoNum = $NossoNum . (string)$valor;
	}
	
	$NossoNum = $NossoNum . (string)(CalculaDV11NN($NossoNum));
	return $NossoNum;
}

function NossoNumero13PosBD($Mes, $Ano, $Sequencial, $carteira){
	global $DB;
	
	$i = 0;
	$NossoNum = $carteira;
	$ds1 = $DB->Execute("Select codigo_reduzido as CodigoReduzidoBD from bancos where sigla='RU'");
	
	if($ds1->fields['CodigoReduzidoBD'] == ''){
		$NossoNum = $NossoNum . '0000';
	}
	else{
		$NossoNum = $NossoNum . '' . $ds1->fields['CodigoReduzidoBD'];
	}
	
	$ds = $DB->Execute("Select Max(nosso_numero) as nosso_numero from parcelas where nosso_numero like '".$NossoNum."%'");
	if($ds->fields['nosso_numero'] == ''){
		$NossoNum = $NossoNum . '0000001';
	}
	else{
		$valor = ((int)(substr((string)$ds->fields['nosso_numero'],6,7))) + 1;
		while($i <= (6-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
		$NossoNum = $NossoNum . (string)$valor;
	}
	
	$NossoNum = $NossoNum . CalculaDV11NNBRD($NossoNum);
	return $NossoNum;
}

function NossoNumero15posSIGCB($Carteira = null){
	global $DB;
	$i= 0;
    $Carteira = trim($Carteira);
    $prefixo_nn = ($Carteira == 'RG') ? '14' : '24'; //verifica se eh registrada RG = com registro
	
	//NossoNumero + Bloco Atual do Aluno
	$sql= "Select Max(nosso_numero) as max from parcelas where banco_id in (select id from bancos where sigla in ('SR')) and LENGTH(nosso_numero) = '17' and nosso_numero like '".$prefixo_nn."%'";
	$ds1 = $DB->Execute($sql);
	
	//novo - contas a receber
	$mensalidades = $ds1->fields['max'];
	$mensalidadesCR = substr($ds1->fields['max'],2,15);
	
	if($mensalidades == ''){
	 $mensalidades = '0';
	}
	if($mensalidadesCR == ''){
	 $mensalidadesCR = '0';
	}
	//echo $mensalidadesCR.' - ';

	// --- fim novo ---
	if(($mensalidades == '') or ($mensalidades == '0')){

        $NossoNum = $prefixo_nn.'000000000000001';
    }
    else
	{
		$valor = (int)substr($mensalidades,2,17) + 1;
        $NossoNum = '';
	 	while($i <= (14- strlen((string)$valor)))
	 	{
	    	$NossoNum = $NossoNum.'0';
	     	$i++;
		}
        $NossoNum =  $prefixo_nn.$NossoNum.$valor;
	}
//		if ($maxCR  == ''){
//			$NossoNum = '24000000000000001';
//		}else{
//		 	$valor =  int($maxCR,3,17) + '1';
//		 	while($i <= (14-strlen(valor)))
//		 	{
//		    	$NossoNum = $NossoNum + '0';
//		     	$i++;
//		    }
//		    $NossoNum = '24'.$NossoNum. $valor;
//		}
				
	return $NossoNum;
}

function NossoNumero13PosBRAD($Mes, $Ano, $Sequencial, $carteira = '06'){
	global $DB;
	
	$i = 0;
	$NossoNum = $carteira;
	$ds1 = $DB->Execute("Select codigo_reduzido as CodigoReduzidoBD from bancos where sigla='BR'");
	
	$ds1->fields['CodigoReduzidoBD'] = trim($ds1->fields['CodigoReduzidoBD']);//tratamento para espaço
	if($ds1->fields['CodigoReduzidoBD'] == '')
		$NossoNum = $NossoNum . '0000';
	else
		$NossoNum = $NossoNum . '' . $ds1->fields['CodigoReduzidoBD'];
	
	$i = 0;
	$ds = $DB->Execute("Select Max(nosso_numero) as max from parcelas where nosso_numero like '".$NossoNum."%'");
	if($ds->fields['max'] == ''){
		$NossoNum = $NossoNum . '0000001';
	}
	else{
		$valor = (int)substr($ds->fields['max'],6,7) + 1;
		while($i <= (6-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
		$NossoNum = $NossoNum . $valor;
	}
		
	$NossoNum = $NossoNum . CalculaDV11BR($NossoNum);
	return $NossoNum;
}

function NossoNumeroItau(){
	global $DB;
	
	$i = 0;
	$ds1 = $DB->Execute("Select Max(nosso_numero) as max from parcelas where LENGTH(nosso_numero) = '8' and not (nosso_numero like '%A%' or nosso_numero like '%B%' or
    	nosso_numero like '%C%' or nosso_numero like '%D%' or nosso_numero like '%E%' or nosso_numero like '%F%' or nosso_numero like '%G%' or
    	nosso_numero like '%H%' or nosso_numero like '%I%' or nosso_numero like '%J%' or nosso_numero like '%L%' or nosso_numero like '%M%' or
    	nosso_numero like '%N%' or nosso_numero like '%O%' or nosso_numero like '%P%' or nosso_numero like '%Q%' or nosso_numero like '%R%' or
    	nosso_numero like '%S%' or nosso_numero like '%T%' or nosso_numero like '%U%' or nosso_numero like '%V%' or nosso_numero like '%X%' or
    	nosso_numero like '%Z%' or nosso_numero like '%-%')");

	if($ds1->fields['max'] == ''){
		$NossoNum = '00000001';
	}
	else{
		$valor = (int)$ds1->fields['max'] + 1;
        $NossoNum = '';
		While($i <= (7-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
		$NossoNum = $NossoNum . $valor;
	}

	return $NossoNum;
}

function NossoNumeroSANTANDER(){
	global $DB;
	
	$i = 0;
	$ds1 = $DB->Execute("Select Max(SUBSTRING(nosso_numero,1,12)) as max from parcelas where len(nosso_numero) = '13' and not (nosso_numero like '%A%' or nosso_numero like '%B%' or
    	nosso_numero like '%C%' or nosso_numero like '%D%' or nosso_numero like '%E%' or nosso_numero like '%F%' or nosso_numero like '%G%' or
    	nosso_numero like '%H%' or nosso_numero like '%I%' or nosso_numero like '%J%' or nosso_numero like '%L%' or nosso_numero like '%M%' or
    	nosso_numero like '%N%' or nosso_numero like '%O%' or nosso_numero like '%P%' or nosso_numero like '%Q%' or nosso_numero like '%R%' or
    	nosso_numero like '%S%' or nosso_numero like '%T%' or nosso_numero like '%U%' or nosso_numero like '%V%' or nosso_numero like '%X%' or
    	nosso_numero like '%Z%')");
	if($ds1->fields['max'] == ''){
		$NossoNum = '000000000001';
	}
	else{
		$valor = (int)$ds1->fields['max'] + 1;
		$NossoNum = '';
        While($i <= (11-strlen((int)($valor)))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
        $NossoNum = $NossoNum . $valor;
	}
	$NossoNum = $NossoNum . '' . Modulo11SANTANTER('nossonumero',$NossoNum);
	
	return $NossoNum;
}

function NossoNumero6PosBIC($Carteira){
	global $DB;
	
	$i = 0;
	$ds = $DB->Execute("select radical+''+matricula_banco as radical from bancos where id in (select id from bancos where Sigla in ('BI'))");
	$RadicalMatricula = (string)$ds->fields['radical'];

	if(strlen($RadicalMatricula) != 5){
		echo('Os campos Radical e Matricula do Banco no cadastro de documento de cobrança devem juntos ter 5 caracteres.');
        die;
    }
	$ds1 = $DB->Execute("Select Max(nosso_numero) as max from parcelas where LENGTH(nosso_numero) = '13' and not (nosso_numero like '%A%' or nosso_numero like '%B%' or
    	nosso_numero like '%C%' or nosso_numero like '%D%' or nosso_numero like '%E%' or nosso_numero like '%F%' or nosso_numero like '%G%' or
    	nosso_numero like '%H%' or nosso_numero like '%I%' or nosso_numero like '%J%' or nosso_numero like '%L%' or nosso_numero like '%M%' or
    	nosso_numero like '%N%' or nosso_numero like '%O%' or nosso_numero like '%P%' or nosso_numero like '%Q%' or nosso_numero like '%R%' or
    	nosso_numero like '%S%' or nosso_numero like '%T%' or nosso_numero like '%U%' or nosso_numero like '%V%' or nosso_numero like '%X%' or
    	nosso_numero like '%Z%') and banco_id in (select id from bancos where sigla in ('BI'))");
	
	$mensalidades = $ds1->fields['max'];
	if($mensalidades == '')
		$mensalidades = '0';
	else
		$mensalidades = substr($mensalidades,7,6);

	if($mensalidades == ''){
		$NossoNum = '000001';
	}
	else{
		$valor = (int)$mensalidades + 1;
        $NossoNum = '';
		While($i <= (5-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
		$NossoNum = $NossoNum . $valor;
	}
	
    $NossoNum = $Carteira.''.$RadicalMatricula.''.$NossoNum;
	return $NossoNum;
}

function NossoNumeroHSBC($CodCliente){
	global $DB;
	
	$i = 0;
	$ds1 = $DB->Execute("Select Max(SUBSTRING(nosso_numero,1,10)) as max from parcelas where LENGTH(nosso_numero) = '11' and not (nosso_numero like '%A%' or nosso_numero like '%B%' or
    	nosso_numero like '%C%' or nosso_numero like '%D%' or nosso_numero like '%E%' or nosso_numero like '%F%' or nosso_numero like '%G%' or
    	nosso_numero like '%H%' or nosso_numero like '%I%' or nosso_numero like '%J%' or nosso_numero like '%L%' or nosso_numero like '%M%' or
    	nosso_numero like '%N%' or nosso_numero like '%O%' or nosso_numero like '%P%' or nosso_numero like '%Q%' or nosso_numero like '%R%' or
    	nosso_numero like '%S%' or nosso_numero like '%T%' or nosso_numero like '%U%' or nosso_numero like '%V%' or nosso_numero like '%X%' or
    	nosso_numero like '%Z%') and nosso_numero like '".$CodCliente."%' ");
	
	if($ds1->fields['max'] == ''){
		$NossoNum = $CodCliente . '00001';
	}
	else{
		$valor =(int)substr($ds1->fields['max'],5,5) + 1;
        $NossoNum = '';
		While($i <= (4-strlen((string)$valor))){
			$NossoNum = $NossoNum . '0';
			$i++;
		}
		$NossoNum = $NossoNum . '' . $valor;
		$NossoNum = $CodCliente . '' . $NossoNum;
	}
	
	$NossoNum = Completa($NossoNum . '' . Modulo11HSBC('nossonumero',$NossoNum,7), 'NI', 11);
	
	return $NossoNum;
}

function CalculaDV11NN($numero_base){
	// function do Calculo de DV Módulo 11
	$tamanho_num = strlen($numero_base);
	$peso = 2;
	$soma = 0;

	for($i = ($tamanho_num-1); $i >=0; $i--){
		$soma = $soma + (int)$numero_base[$i] * $peso;
		if($peso == 9)
			$peso = 2;
		else
			$peso = $peso + 1;
	}
	$resto = $soma % 11;
	$resto = 11 - $resto;
	if($resto > 9)
		return 0;
	else
		return $resto;
}

function CalculaDV11NNBRD($numero_base){
	// function do Calculo de DV Módulo 11
	$tamanho_num = strlen($numero_base);
	$peso = 2;
	$soma = 0;
	for($i=($tamanho_num-1); $i >= 0; $i--){
		$soma = $soma + ((int)$numero_base[$i] * $peso);
		if($peso == 7)
			$peso = 2;
		else
			$peso = $peso + 1;
	}
	$resto = $soma % 11;
	
	if(($resto == 0) or ($resto > 9))
		$resto2 = '0';
	
		
	if($resto == 1)
		$resto2 = 'P';
		
	if(($resto >= 2) and ($resto <= 9)){
		$resto = 11 - $resto;
 		$resto2 = (string)$resto;
	}
	
	return $resto2;
}

function Modulo11SANTANTER($Origem, $Valor, $Base = 9, $Resto = false){
	/*
	 *    Rotina muito usada para calcular dígitos verificadores
   Pega-se cada um dos dígitos contidos no parâmetro VALOR, da direita para a
   esquerda e multiplica-se pela seqüência de pesos 2, 3, 4 ... até BASE.
   Por exemplo: se a base for 9, os pesos serão 2,3,4,5,6,7,8,9,2,3,4,5...
   Se a base for 7, os pesos serão 2,3,4,5,6,7,2,3,4...
   Soma-se cada um dos subprodutos.
   Divide-se a soma por 11.
   Faz-se a operação 11-Resto da divisão e devolve-se o resultado dessa operação
   como resultado da função Modulo11.
   Obs.: Caso o resultado seja
       maior que 9, deverá ser substituído por 0 (ZERO).
	 */
	$Soma = 0;
   	$Peso = 2;
    $Valor = $Valor;
   	for($Contador =((strlen($Valor))-1); $Contador >=0; $Contador--){

        $Soma = $Soma + ((int)$Valor[$Contador] * $Peso);
   		if($Peso < $Base)
   			$Peso = $Peso + 1;
   		else
   			$Peso = 2;
   	}
   	
   	if($Resto){
        $result = $Soma % 11;
   	}
   	else{
   		$RestoCalculo = ($Soma % 11);
        if(($RestoCalculo != 1) and ($RestoCalculo != 0) and ($RestoCalculo != 10)){
   			$Digito = 11 - $RestoCalculo;
   			if($Digito > 9)
   				$Digito = 1;
   			if($Digito < 0)
   				$Digito = 0;
   		}
   		else{
   			if($Origem == 'codbarras'){
   				$Digito = 1;
   			}
   			else{
   				if($RestoCalculo == 10)
   					$Digito = 1;
   				else
   					$Digito = 0;
   			}
   		}
   		
        $result = $Digito;
   	}
   	
   	return $result;
}

function Modulo11HSBC($origem, $Valor, $Base = 9, $Resto = false){
	/*
	 *  Rotina muito usada para calcular dígitos verificadores
   Pega-se cada um dos dígitos contidos no parâmetro VALOR, da direita para a
   esquerda e multiplica-se pela seqüência de pesos 2, 3, 4 ... até BASE.
   Por exemplo: se a base for 9, os pesos serão 2,3,4,5,6,7,8,9,2,3,4,5...
   Se a base for 7, os pesos serão 2,3,4,5,6,7,2,3,4...
   Soma-se cada um dos subprodutos.
   Divide-se a soma por 11.
   Faz-se a operação 11-Resto da divisão e devolve-se o resultado dessa operação
   como resultado da função Modulo11.
   Obs.: Caso o resultado seja
       maior que 9, deverá ser substituído por 0 (ZERO).
	 */
	$Soma = 0;
   	$Peso = 2;	
   	$Valor = (string)$Valor;
   	for($Contador = (strlen($Valor)-1); $Contador >= 0; $Contador--){
   		$Soma = $Soma + ((int)$Valor[$Contador] * $Peso);
   		if($Peso < $Base)
   			$Peso = $Peso + 1;
   		else
   			$Peso = 2;
   	}
   	
   	if($Resto){
   		$result = (string)($Soma % 11);
   	}
   	else{
   		$RestoCalculo = ($Soma % 11);
   		if((($origem == 'nossonumero')and($RestoCalculo <> 1)and($RestoCalculo <> 0))or
      	(($origem == 'codbarras')and($RestoCalculo <> 1)and($RestoCalculo <> 0)and($RestoCalculo <> 10))){
      		$Digito = 11 - $RestoCalculo;
      		if($Digito > 9)
      			$Digito = 1;	
      		if($Digito < 0)
      			$Digito = 0;
      	}
      	else{
      		if($origem == 'codbarras')
      			$Digito = 1;
      		else
      			$Digito = 0;
      	}
      	
      	$result = (string)$Digito;
   	}
   	return $result;
}




/** 
 * Função nova usada para gera valor do documento com os zeros
 * 
 */
function FormataValorBoleto($Valor, $QuantDigitos)
{
    $AValorDocumento = number_format($Valor, 2, '.', '');
    $AValorDocumento = RemoveChar($AValorDocumento);
    $i = 0;
    While ($i <= (($QuantDigitos-1)-strlen((string)$Valor)))
    {
        $AValorDocumento = '0'.$AValorDocumento;
        $i++;
    }
    return $AValorDocumento;
}

function CodCarteira($TipoBanco){
	global $DB;	

	$Siglabancos = array('HS','BI','IT','BR','BN','BB','RC','RS');
	
	$idBanco = $TipoBanco;
	$sql = "select sigla, carteira from bancos where id='".$TipoBanco."'";
	$ds =  $DB->Execute($sql);
  	$Sigla = trim($ds->fields['sigla']);
    $Carteira = trim($ds->fields['carteira']);
  	if(($Sigla == 'BS') or ($Sigla == 'HS'))
    	$TipoBanco = $Sigla;
    	
    $result = '0';
    
    if($Sigla == 'CS')
    	$result = '14';
	
	if($Sigla == 'CR')
		$result = '12';
	
    if($Sigla == 'SR'){
        if($Carteira){
            $result = $Carteira;
        }
        else{
		$result = '02';
        }
    }

    if(($Sigla == 'RC') or ($Sigla == 'RS')){
        if(!$Carteira)
            $result = 20;
        else
            $result = $Carteira;
    }
	
	if($Sigla == 'US')
    	$result = '20';
    
    if($Sigla == 'BB'){
        $result = $Carteira;
    }

    if($Sigla == 'RU')
    	$result = '19';

    if(in_array($Sigla, $Siglabancos)){
    	$sql = "Select carteira from bancos where id = '".$idBanco."'";
    	$ds = $DB->Execute($sql);
    	
    	$ds->fields['carteira'] = trim($ds->fields['carteira']);
    	$result = (strlen($ds->fields['carteira']) < 2) ? '0'.$ds->fields['carteira'] : $ds->fields['carteira'];
    }
    
    if($Sigla == 'BR'){
        if($Carteira)
            $result = $Carteira;
        else
    	$result = '06';
    }
    
 
    
    return $result;
}

function Multa($TipoBanco){
	global $DB;
	
	$ds = $DB->Execute("Select multa from bancos where id='".$TipoBanco."'");
    $result = $ds->fields['multa'];
    
    return $result;
}

function PrazoMulta($TipoBanco){
	global $DB;
	
	$ds = $DB->Execute("Select prazo_multa from bancos where id='".$TipoBanco."'");
    $result = $ds->fields['prazo_multa'];
    
    return $result;
}

function DtMulta($Data, $TipoBanco){
	global $DB;
	
    $ds = $DB->Execute("Select prazo_multa from bancos where id='".$TipoBanco."'");
    $result = Datafinal($Data,$ds->fields['prazo_multa']);
     
    return $result;
}

function Datafinal($dataini, $dias, $operador = "+"){
	//$dw = DayOfWeek($dataini)-1;
	$dias = (int)  $dias;
    
    if($dataini){

	list($day, $month, $year) = split('[/.-]', $dataini);

    if($day and $month and $year):
        $dataini = mktime(0, 0, 0, $month, $day, $year);

        $nova = strtotime($operador . $dias . "days", $dataini);

        $dataincre = date("d/m/Y", $nova);
	endif;
  	return $dataincre;

    }

}

function Desconto($TipoBanco){
	global $DB;

	$ds = $DB->Execute("Select desconto from bancos where id='".$TipoBanco."'");
	$result = $ds->fields['Desconto'];

    
    return $result;
}

function DtDesconto($Data, $TipoBanco){
	global $DB;
		
	$ds = $DB->Execute("Select prazo_desconto from bancos where id='".$TipoBanco."'");
    $result = Datafinal($Data,$ds->fields['PrazoDesconto']);
    
    return $result;
}

function Juros($TipoBanco){
	global $DB;
	
    $ds = $DB->Execute("Select juros from bancos where id='".$TipoBanco."'");
	
    $result = $ds->fields['juros'];
			
    return $result;
}

function ProtestoDevolucao($TipoBanco){
	global $DB;
	
	$ds = $DB->Execute("Select protesto_devolucao from bancos where id='".$TipoBanco."'");
	$result = $ds->fields['protesto_devolucao'];
      	
    return $result;
}

function PrazoProtestoDevolucao($TipoBanco){
	global $DB;
	
	$ds = $DB->Execute("Select prazo_protesto_devolucao from bancos where id='".$TipoBanco."'");
    $result = $ds->fields['PrazoProtestoDevolucao'];
     
    return $result;
}

function SeuNumero($Parc, $cliente_id, $Sequencial){ // verificar
	$i = 0;
	$j = 0;
	$SeuNumero = '';
	While($i <= (1-strlen($Parc))){
		$SeuNumero =  $SeuNumero . '0';
    	$i++;
	}
	
	$SeuNumero = $SeuNumero + $Parc;
	
	While($j <= (1-strlen($Sequencial))){
		$SeuNumero =  $SeuNumero . '0';
    	$j++;
	}
	
	$SeuNumero = $SeuNumero . $Sequencial;
	$SeuNumero = $SeuNumero . date("y");
	$SeuNumero = $SeuNumero . $cliente_id;
	$result = $SeuNumero;
	
	return $result;
}
    
    
function GeraNossoNumeroOutrasContas()
{
      global $DB;
      
      $sql = "Select (MAX(CAST(SUBSTRING(nosso_numero,1,(LENGTH(nosso_numero)-4)) AS UNSIGNED)))+1 as NossoNumero from parcelas where SUBSTRING(nosso_numero,(LENGTH(nosso_numero)-3), LENGTH(nosso_numero)) = 'NNCR' ";
      
      $rs = $DB->Execute($sql);
      
      $NossoNumeroCR = $rs->fields['NossoNumero'];
      
      if ($NossoNumeroCR == '')    $NossoNumeroCR = '1NNCR';        
      else  $NossoNumeroCR = $NossoNumeroCR.'NNCR';
        
    
      return $NossoNumeroCR;
}

function CalculaDV11BR($numero_base)
{
//{------------------------------------------------------------------------------}
//{ function do Calculo de DV Módulo 11 }
//{------------------------------------------------------------------------------}
  $tamanho_num = strlen($numero_base);
  $peso = 2;
  $soma = 0;
  for($i = ($tamanho_num-1); $i >= 0; $i--){

      $soma = $soma + (intval($numero_base[$i]) * $peso);
      if($peso == 7)
        $peso = 2;
      else
        $peso = $peso + 1;
  }

  $resto = $soma % 11;

  if ($resto == 0)
      $resto2 = '0';


  if ($resto == 1)
      $resto2 = 'P';

  if ($resto >= 2) {
      $resto = 11 - $resto;
      $resto2 = $resto;
  }

  return  $resto2;

}

function confirma($mensagem, $acao)
{
	$acao = " Deseja $acao o caixa agora?";
    echo
        "<script>
            if(window.confirm('".$mensagem.$acao."'))
            {

    	    }
    	    else
            {
    		    document.location='index.php?s=1';
            }
        </script>"
    ;
}

function baixar_parcela($nosso_numero,$situacao_pago,$ocorrencia_retorno_id,$usuario_id){

	global $DB;

	$objP = new Parcelas();

    $objP->load('nosso_numero=?', $nosso_numero);
    $objP->situacao_pagamento_id = $situacao_pago;
    $parcela_id = $objP->id;
    $ok = $objP->save();  // esse save() vai retornar um UPDATE ou INSERT

    $obj = new Baixa();

    $obj->tela = 'retorno';

    $obj->ocorrencia_retorno_id = $ocorrencia_retorno_id;

    $obj->usuario_id = $usuario_id;

    $obj->parcela_id = $parcela_id;

    $obj->status = 1;

    $obj->created = date('Y-m-d H:i:s') ;

    $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT


}


//TODO: calcula_valor - Calcula parcelas do tipo mensalidades
function calcula_valor($DataPagamento, $NossoNumero, $Leiaute = '') {
    //Formato da Data 99/99/9999
    include("config/conexaoFc.php");
    $NaoGeraMultaJuros = 'N';    
    $filtroNossoNumero = 'nosso_numero';
    if ($Leiaute == "BANCO SANTANDER - 400") {
        $filtroNossoNumero = ' substring(nosso_numero,6,8)';
    }elseif($Leiaute == "BIC - BANCO - 400") {
        $filtroNossoNumero = ' substring(nosso_numero,8,6)';
    }

    //$DB->debug=true;
    $sql = "select valor, data_vencimento as DtVencimento,data_vencimento as DtVencimentoOriginal, condicao_juros as CondicaoJuros, 
		base_juros as BaseJuros, nosso_numero as NossoNumero from parcelas
	 where " . $filtroNossoNumero . " = '" . $NossoNumero . "'"
        . " or (nosso_numero = '" . substr($NossoNumero, 6, 7) . "' and banco_id is not null and banco_id in ( select id from bancos where Sigla in ('RC','RS','IT')))";
    $rs = $DB->Execute($sql);
    $NossoNumeroGeneses = $rs->fields['NossoNumero'];
    if ($rs->RecordCount() > 0) {
        $DtVencimentoMultaJuros = $rs->fields['DtVencimento'];
        $DtVencimento = $rs->fields['DtVencimentoOriginal'];
        if (empty($rs->fields['DtVencimentoOriginal']) || $rs->fields['DtVencimentoOriginal'] == NULL) {
            $DtVencimento = $rs->fields['DtVencimento'];
        }
        $CondicaoJuros = $rs->fields['CondicaoJuros'];
        $BaseJuros = $rs->fields['BaseJuros'];
        $DataVencimento = $rs->UserTimeStamp($DtVencimento, 'd/m/Y');
        $DataVencimentoMultaJuros = $rs->UserTimeStamp($DtVencimentoMultaJuros, 'd/m/Y');
        $ValorBoleto = $rs->fields['valor'];
        $contar_dias1 = contar_dias($NossoNumero, $DataVencimento, $DataPagamento);
        $QuantDias = $contar_dias1['dias'];
        $Dataprevista = $contar_dias1['DataPrev'];
        if ($DataVencimento == $DataVencimentoMultaJuros) {
            $contar_dias1MJ = $contar_dias1;
            $QuantDiasMJ = $QuantDias;
            $DataprevistaMJ = $Dataprevista;
        }#
        else {
            $contar_dias1MJ = contar_dias($NossoNumero, $DataVencimentoMultaJuros, $DataPagamento);
            $QuantDiasMJ = $contar_dias1MJ['dias'];
            $DataprevistaMJ = $contar_dias1MJ['DataPrev'];
        }
        //condicao 1
        $DataVencimento1 = explode("/", $DataVencimento);
        $ano_ven = $DataVencimento1[2];
        $mes_ven = $DataVencimento1[1];
        $dia_ven = $DataVencimento1[0];
        $DataPagamento1 = explode("/", $DataPagamento);
        $ano_pag = $DataPagamento1[2];
        $mes_pag = $DataPagamento1[1];
        $dia_pag = $DataPagamento1[0];
        $verificacao = false;
        if ($ano_ven . $mes_ven . $dia_ven >= $ano_pag . $mes_pag . $dia_pag){
            $verificacao = true;
        }
        //condicao 2
        $DataVencimento1 = explode("/", $DataVencimento);
        $ano_ven = $DataVencimento1[2];
        $mes_ven = $DataVencimento1[1];
        $dia_ven = $DataVencimento1[0];
        $DataPagamento1 = explode("/", $DataPagamento);
        $ano_pag = $DataPagamento1[2];
        $mes_pag = $DataPagamento1[1];
        $dia_pag = $DataPagamento1[0];
        $verificacao2 = false;
        if ($ano_ven . $mes_ven . $dia_ven < $ano_pag . $mes_pag . $dia_pag){
            $verificacao2 = true;
        }
        //condicao 3
        $DataVencimento1 = explode("/", $DataVencimento);
        $ano_ven = $DataVencimento1[2];
        $mes_ven = $DataVencimento1[1];
        $dia_ven = $DataVencimento1[0];
        $DataPagamento1 = explode("/", $Dataprevista);
        $ano_pag = $DataPagamento1[2];
        $mes_pag = $DataPagamento1[1];
        $dia_pag = $DataPagamento1[0];
        $verificacao3 = false;
        if ($ano_ven . $mes_ven . $dia_ven >= $ano_pag . $mes_pag . $dia_pag)
            $verificacao3 = true;
        /*
          essa condição só entra boletos pagos antes ou até o vencimento ou se pagar depois por motivo de feriado ou fim de semana, foi retirada a condição
          para boletos depois do vencimento com dias negativos pois estava dando problema na ICF de aluno com desconto antecipado e ate o vencimento ganhando desconto
         */
        if (($verificacao == true) or ( ($verificacao2 == true) and ( $QuantDias <= 0) and 1 == 0) or ( ($verificacao3 == true) and ( $verificacao2 == true))) {
            
        }#
        else {
            if ($QuantDias < 0){
                $QuantDias = $QuantDias * (-1); //muda a quantidade para positivo
            }

            //{ -- Verifica Condicao -- }
            if ($CondicaoJuros == '') {
                $sql2 = "select condicao_juros as CondicaoJuros, base_juros as BaseJuros from parametro";
                $rs2 = $DB->Execute($sql2);
                $CondicaoJuros = $rs2->fields['CondicaoJuros'];
                $BaseJuros = $rs2->fields['BaseJuros'];
            }

            //{ -- Verifica Condicao 5 dia util -- }
            if (($CondicaoJuros == 'D') and ( $BaseJuros == 'X')) {
                $DataLimite = somaData($DataVencimentoMultaJuros, '+', 0, 1, 0);
                $DataLimiteStr = $DataLimite;
                $DataLimite = '01' . substr($DataLimiteStr, 2, 10);
                $DiasUteis = 0;

                while ($DiasUteis < 4) {
                    if (verifica_dias($DataLimite) != 0){
                        $DiasUteis++;
                    }
                    //$DB->debug=true;
                    $sql2 = "select ADDDATE('" . substr($DataLimite, 6, 4) ."-". substr($DataLimite, 3, 2) ."-". substr($DataLimite, 0, 2) . "',1) as data";

                    $rs2 = $DB->Execute($sql2);

                    $DataLimite = $rs2->fields['data'];
                }

                $DataVencimento1 = explode("/", $DataLimite);
                $ano_ven = $DataVencimento1[2];
                $mes_ven = $DataVencimento1[1];
                $dia_ven = $DataVencimento1[0];

                $DataPagamento1 = explode("/", $DataPagamento);
                $ano_pag = $DataPagamento1[2];
                $mes_pag = $DataPagamento1[1];
                $dia_pag = $DataPagamento1[0];

                $verificacao = false;
                if ($ano_ven . $mes_ven . $dia_ven >= $ano_pag . $mes_pag . $dia_pag)
                    $verificacao = true;

                if ($verificacao == true) {
                    $NaoGeraMultaJuros = 'S';
                }
            }

            //{ -- Verifica Condicao X DIAS APÓS -- }
            if (($CondicaoJuros == 'D') and ( $BaseJuros != 'X') and ( $BaseJuros != '')) {

                $BaseJurosInt = $BaseJuros;
                $DataLimite = somaData($DataVencimentoMultaJuros, '+', 0, 1, 0);
                $DataLimiteStr = $DataLimite;
                $DataLimite = '01' . substr($DataLimiteStr, 2, 10);
                $DiasUteis = 0;
                while ($DiasUteis < ($BaseJurosInt - 1)) {

                    //if(verifica_dias(DataLimite)<>0)then
                    $DiasUteis++;

                    //$DB->debug=true;
                    $sql2 = "select ADDDATE('" . substr($DataLimite, 6, 4) ."-". substr($DataLimite, 3, 2) ."-". substr($DataLimite, 0, 2) . "',1) as data";

                    $rs2 = $DB->Execute($sql2);

                    $DataLimite = formata_data($rs2->fields['data']);
                }

                $DataVencimento1 = explode("/", $DataLimite);
                $ano_ven = $DataVencimento1[2];
                $mes_ven = $DataVencimento1[1];
                $dia_ven = $DataVencimento1[0];

                $DataPagamento1 = explode("/", $DataPagamento);
                $ano_pag = $DataPagamento1[2];
                $mes_pag = $DataPagamento1[1];
                $dia_pag = $DataPagamento1[0];

                if ($ano_ven . $mes_ven . $dia_ven >= $ano_pag . $mes_pag . $dia_pag) {
                    $NaoGeraMultaJuros = 'S';
                }
            }
        }

        if ($MensagemDesc > $MensagemAcres) {

            $MensagemDesc = $MensagemDesc - $MensagemAcres;
            $MensagemAcres = 0;
        } else {
            $MensagemAcres = $MensagemAcres - $MensagemDesc;
            $MensagemDesc = 0;
        }

        if (($MensagemDesc > 0) or ( $MensagemAcres > 0)) {

            $valor = $ValorBoleto + $MensagemAcres - $MensagemDesc;
        } else {

            $sql2 = "select multa as Multa, 0 as ValorJuros, 0 AS DiasAtraso,
                   parcela as Parcela,now(), prazo_multa as PrazoMulta, data_vencimento as DtVencimento, 
juros as Juros, valor, (case when base_juros is null or base_juros='' then (select base_juros from parametro)
                   else base_juros end) as BaseJuros,(case when condicao_juros is null or condicao_juros='' then 
	(select condicao_juros from parametro) else condicao_juros
                   end) as CondicaoJuros  from parcelas as v where nosso_numero='" . $NossoNumeroGeneses . "'";


            $rs2 = $DB->Execute($sql2);

            $valor = $rs2->fields['valor'];

            if ($NaoGeraMultaJuros == 'N') {
                if ($NossoNumero != '') {
                    //$QuantDiasMJ." ".$rs2->fields['PrazoMulta']." ".$DataVencimentoMultaJuros." ".$DataPagamento;

                    $DataVencimento1 = explode("/", $DataVencimentoMultaJuros);
                    $ano_ven = $DataVencimento1[2];
                    $mes_ven = $DataVencimento1[1];
                    $dia_ven = $DataVencimento1[0];

                    $DataPagamento1 = explode("/", $DataPagamento);
                    $ano_pag = $DataPagamento1[2];
                    $mes_pag = $DataPagamento1[1];
                    $dia_pag = $DataPagamento1[0];

                    $verificacao = false;
                    if ($ano_ven . $mes_ven . $dia_ven < $ano_pag . $mes_pag . $dia_pag)
                        $verificacao = true;
                    if ($QuantDiasMJ < 0)
                        $QuantDiasMJ = $QuantDiasMJ * -1;

                    if (($QuantDiasMJ > $rs2->fields['PrazoMulta']) and ( $verificacao == true)) {
                        $Multa = number_format($rs2->fields['Multa'], 2, '.', '');
                        $valor = $valor + $Multa;
                    } else {
                        $Multa = 0;
                    }

                    $DataVencimento1 = explode("/", $DataVencimentoMultaJuros);
                    $ano_ven = $DataVencimento1[2];
                    $mes_ven = $DataVencimento1[1];
                    $dia_ven = $DataVencimento1[0];

                    $DataPagamento1 = explode("/", $DataPagamento);
                    $ano_pag = $DataPagamento1[2];
                    $mes_pag = $DataPagamento1[1];
                    $dia_pag = $DataPagamento1[0];

                    $verificacao = false;
                    if ($ano_ven . $mes_ven . $dia_ven >= $ano_pag . $mes_pag . $dia_pag)
                        $verificacao = true;

                    if (($QuantDiasMJ == 0) or ( $verificacao == true)) {
                        $Multa = 0;
                        $Juros = 0;
                    } else {
                        if ($QuantDiasMJ > 0) {
                            $Juros = number_format(($rs2->fields['Juros'] * ($QuantDiasMJ)), 2, '.', ''); //strtofloat(LValorJuros.Caption);
                            if (($rs2->fields['CondicaoJuros'] == 'V') or ( $rs2->fields['CondicaoJuros'] == '')) {
                                $valor = $valor + $Juros;
                            } else {

                                $data1 = explode("/", $rs->UserTimeStamp($rs2->fields['DtVencimento']), 'd/m/Y');
                                $anoVenc = $data1[2];
                                $mesVenc = $data1[1];
                                $dia = $data1[0];

                                $data1 = explode("/", $DataPagamento);

                                $anoPg = $data1[2];
                                $mesPg = $data1[1];
                                $dia = $data1[0];

                                if (($mesVenc < $mesPg) or ( $anoVenc < $anoPg)) {
                                    $valor = $valor + $Juros;
                                } else {
                                    $Juros = 0;
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        $valor = 0;
    }
    $retorno = array();

    $retorno['ValorMulta'] = number_format($Multa, 2, '.', '');
    $retorno['ValorJuros'] = number_format($Juros, 2, '.', '');
    $retorno['MensagemDesc'] = number_format($MensagemDesc, 2, '.', '');
    $retorno['MensagemAcres'] = number_format($MensagemAcres, 2, '.', '');
    $retorno['MultaRecebido'] = $Multa;
    $retorno['JurosRecebido'] = $Juros;

    $DataVencimento1 = explode("/", $DataVencimentoMultaJuros);
    $ano_ven = $DataVencimento1[2];
    $mes_ven = $DataVencimento1[1];
    $dia_ven = $DataVencimento1[0];

    $DataPagamento1 = explode("/", $DataPagamento);
    $ano_pag = $DataPagamento1[2];
    $mes_pag = $DataPagamento1[1];
    $dia_pag = $DataPagamento1[0];

    $verificacao = false;
    if ($ano_ven . $mes_ven . $dia_ven < $ano_pag . $mes_pag . $dia_pag)
        $verificacao = true;

    if (($QuantDiasMJ > 0) and ( $verificacao == true))
        $retorno['QtdeDias'] = $QuantDiasMJ . ' depois';

    $DataVencimento1 = explode("/", $DataVencimentoMultaJuros);
    $ano_ven = $DataVencimento1[2];
    $mes_ven = $DataVencimento1[1];
    $dia_ven = $DataVencimento1[0];

    $DataPagamento1 = explode("/", $DataPagamento);
    $ano_pag = $DataPagamento1[2];
    $mes_pag = $DataPagamento1[1];
    $dia_pag = $DataPagamento1[0];

    $verificacao = false;
    if ($ano_ven . $mes_ven . $dia_ven >= $ano_pag . $mes_pag . $dia_pag)
        $verificacao = true;

    if ($verificacao) {
        if ($QuantDiasMJ < 0) {
            $QuantDiasMJ = $QuantDiasMJ * (-1);
        }
        $retorno['QtdeDias'] = $QuantDiasMJ . ' antes ';
    }
    if (!$verificacao) {
        if ($QuantDiasMJ < 0) {
            $QuantDiasMJ = $QuantDiasMJ * (-1);
        }
        $retorno['QtdeDias'] = $QuantDiasMJ . ' depois';
    }
    if ($QuantDias == 0)
        $retorno['QtdeDias'] = $QuantDiasMJ;


    $retorno['valor'] = $valor;
    return $retorno;
}

/**
 * ATENÇÃO: Criar campo ( DtVencimentoOriginal) em na tabela Mensalidade
 * Arquivo Original ### funcao.inc.php ###
 */
function contar_dias($NossoNumero, $DataVencimento, $DataPagamento) {

    //Formato Data 99/99/999
    include("config/conexaoFc.php");


    #setando a primeira data  10/01/2008
    $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));

    #setando segunda data 10/02/2008
    $dia2 = mktime(0, 0, 0, substr($DataPagamento, 3, 2), substr($DataPagamento, 0, 2), substr($DataPagamento, 6, 4));

    #converter o tempo em dias
    $dia3 = $dia1 - $dia2;

    $QuantDias = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);

    $count = 1;
    $QuantDiasUteis = 0;
    $desconto = false;

    //{ -- Pagamento após vencimento -- }
    $DataVencimento1 = explode("/", $DataVencimento);
    $ano_ven = $DataVencimento1[2];
    $mes_ven = $DataVencimento1[1];
    $dia_ven = $DataVencimento1[0];

    $DataPagamento1 = explode("/", $DataPagamento);
    $ano_pag = $DataPagamento1[2];
    $mes_pag = $DataPagamento1[1];
    $dia_pag = $DataPagamento1[0];

    $verificacao = false;

    if ($ano_ven . $mes_ven . $dia_ven < $ano_pag . $mes_pag . $dia_pag)
        $verificacao = true;

    if ($verificacao == true) { //pagamento após vencimento


        $count = 1;
        $QuantDiasUteis = 0;

        //$DB->debug=true;
        $sql2 = " select ADDDATE('" . substr($DataPagamento, 6, 4) ."-". substr($DataPagamento, 3, 2) ."-". substr($DataPagamento, 0, 2) . "'," . $count * (-1) . ") as data";

        $rs2 = $DB->Execute($sql2);

        $Dataprevista = $rs2->UserTimeStamp($rs2->fields['data'], 'd/m/Y');

        //QuantDias := DaysBetween(DataVencimento,DataPrevista);
        //verifica se o dia vencimento não é dia util

        if (verifica_dias($DataVencimento) == 0) {

            //enquanto não encontra o primeiro dia util, pois o aluno pode ter desconto antecipado e ta pagando depois do vencimento por causa de dias não uteis

            while (verifica_dias($Dataprevista) == 0) {

                $DataVencimento1 = explode("/", $DataVencimento);
                $ano_ven = $DataVencimento1[2];
                $mes_ven = $DataVencimento1[1];
                $dia_ven = $DataVencimento1[0];

                $DataPagamento1 = explode("/", $Dataprevista);
                $ano_pag = $DataPagamento1[2];
                $mes_pag = $DataPagamento1[1];
                $dia_pag = $DataPagamento1[0];

                $verificacao = false;
                if ($ano_ven . $mes_ven . $dia_ven < $ano_pag . $mes_pag . $dia_pag)
                    $verificacao = true;

          
                $count++;
                $QuantDias--;
                $sql2 = "select ADDDATE('" . substr($DataPagamento, 6, 4) ."-". substr($DataPagamento, 3, 2) ."-". substr($DataPagamento, 0, 2) . "'," . $count * (-1) . ") as data";
                $rs2 = $DB->Execute($sql2);

                $Dataprevista = $rs2->UserTimeStamp($rs2->fields['data'], 'd/m/Y');
            }

            $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
            #setando segunda data 10/02/2008
            $dia2 = mktime(0, 0, 0, substr($Dataprevista, 3, 2), substr($Dataprevista, 0, 2), substr($Dataprevista, 6, 4));

            #converter o tempo em dias
            $dia3 = $dia1 - $dia2;

            $QuantDias = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);

            $DataVencimento1 = explode("/", $DataVencimento);
            $ano_ven = $DataVencimento1[2];
            $mes_ven = $DataVencimento1[1];
            $dia_ven = $DataVencimento1[0];

            $DataPagamento1 = explode("/", $Dataprevista);
            $ano_pag = $DataPagamento1[2];
            $mes_pag = $DataPagamento1[1];
            $dia_pag = $DataPagamento1[0];

            $verificacao = false;
            if ($ano_ven . $mes_ven . $dia_ven < $ano_pag . $mes_pag . $dia_pag)
                $verificacao = true;

            if (!$Desconto) {

                $DataVencimento1 = explode("/", $DataVencimento);
                $ano_ven = $DataVencimento1[2];
                $mes_ven = $DataVencimento1[1];
                $dia_ven = $DataVencimento1[0];

                $DataPagamento1 = explode("/", $Dataprevista);
                $ano_pag = $DataPagamento1[2];
                $mes_pag = $DataPagamento1[1];
                $dia_pag = $DataPagamento1[0];

                $verificacao = false;
                if ($ano_ven . $mes_ven . $dia_ven < $ano_pag . $mes_pag . $dia_pag)
                    $verificacao = true;

                if ($verificacao == true) {

                    #setando a primeira data  10/01/2008
                    $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
                    #setando segunda data 10/02/2008
                    $dia2 = mktime(0, 0, 0, substr($DataPagamento, 3, 2), substr($DataPagamento, 0, 2), substr($DataPagamento, 6, 4));

                    #converter o tempo em dias
                    $dia3 = $dia1 - $dia2;

                    $QuantDias = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);

                    $QuantDiasUteis = $QuantDias;
                }
            }
        }else {

            #setando a primeira data  10/01/2008
            $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
            #setando segunda data 10/02/2008
            $dia2 = mktime(0, 0, 0, substr($DataPagamento, 3, 2), substr($DataPagamento, 0, 2), substr($DataPagamento, 6, 4));


            #converter o tempo em dias
            $dia3 = $dia1 - $dia2;

            $QuantDiasUteis = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);
        }
    }

    //{ -- Pagamento antes do vencimento -- }
    $DataVencimento1 = explode("/", $DataVencimento);
    $ano_ven = $DataVencimento1[2];
    $mes_ven = $DataVencimento1[1];
    $dia_ven = $DataVencimento1[0];

    $DataPagamento1 = explode("/", $DataPagamento);
    $ano_pag = $DataPagamento1[2];
    $mes_pag = $DataPagamento1[1];
    $dia_pag = $DataPagamento1[0];

    $verificacao = false;
    if ($ano_ven . $mes_ven . $dia_ven >= $ano_pag . $mes_pag . $dia_pag)
        $verificacao = true;

    if ($verificacao == true) { //pagamento antes do vencimento

        //{ -- Busca primeiro dia util antes do pagamento, p/ saber se a pessoa pagou depois de algum desconto por causa dos dias não-uteis -- }
        $count = 1;
        $QuantDiasUteis = 0;
        $QuantDias = 0;

        //$DB->debug=true;
        $sql2 = "select ADDDATE('" . substr($DataPagamento, 6, 4) ."-". substr($DataPagamento, 3, 2) ."-". substr($DataPagamento, 0, 2) . "'," . $count * (-1) . ") as data";
        
        $rs2 = $DB->Execute($sql2);

        $Dataprevista = $rs2->UserTimeStamp($rs2->fields['data'], 'd/m/Y');

        if (verifica_dias($Dataprevista) == 0) {

            while (verifica_dias($Dataprevista) == 0) {

                $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
                #setando segunda data 10/02/2008
                $dia2 = mktime(0, 0, 0, substr($Dataprevista, 3, 2), substr($Dataprevista, 0, 2), substr($Dataprevista, 6, 4));

                #converter o tempo em dias
                $dia3 =  $dia1 - $dia2;

                $QuantDiasUteis = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);

                $count++;

                $sql2 = "select ADDDATE('" . substr($DataPagamento, 6, 4) ."-". substr($DataPagamento, 3, 2) ."-". substr($DataPagamento, 0, 2) . "'," . $count * (-1) . ") as data";

                $rs2 = $DB->Execute($sql2);

                $Dataprevista = $rs2->UserTimeStamp($rs2->fields['data'], 'd/m/Y');
            }

            $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
            #setando segunda data 10/02/2008
            $dia2 = mktime(0, 0, 0, substr($Dataprevista, 3, 2), substr($Dataprevista, 0, 2), substr($Dataprevista, 6, 4));

            #converter o tempo em dias
            $dia3 =  $dia1 - $dia2;

            $QuantDiasUteis = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);

            if (!$desconto) {

                $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
                #setando segunda data 10/02/2008
                $dia2 = mktime(0, 0, 0, substr($Dataprevista, 3, 2), substr($Dataprevista, 0, 2), substr($Dataprevista, 6, 4));

                #converter o tempo em dias
                $dia3 =  $dia1 - $dia2;

                $QuantDiasUteis = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);
            }else {
                $QuantDiasUteis = $QuantDias;
            }
        }else {

            if (verifica_dias($DataPagamento) == 0) {
                $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
                #setando segunda data 10/02/2008
                $dia2 = mktime(0, 0, 0, substr($Dataprevista, 3, 2), substr($Dataprevista, 0, 2), substr($Dataprevista, 6, 4));

                #converter o tempo em dias
                $dia3 =  $dia1 - $dia2;

                $QuantDiasUteis = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);
            }else {
                $dia1 = mktime(0, 0, 0, substr($DataVencimento, 3, 2), substr($DataVencimento, 0, 2), substr($DataVencimento, 6, 4));
                #setando segunda data 10/02/2008
                $dia2 = mktime(0, 0, 0, substr($DataPagamento, 3, 2), substr($DataPagamento, 0, 2), substr($DataPagamento, 6, 4));

                #converter o tempo em dias
                $dia3 =  $dia1 - $dia2;

                $QuantDiasUteis = round(($dia3 / 60 / 60 / 24)); //DaysBetween(DataVencimento,DataPagamento);
            }
        }
    }

    $retorno = array();

    $retorno['dias'] = $QuantDiasUteis;
    $retorno['DataPrev'] = $Dataprevista;

    return $retorno;
}


function verifica_dias($Data) {

    //Formato Data 99/99/999

    include("config/conexaoFc.php");

    //{ -- Parametros de Multa e Juros -- }
    $Seg = 'S';
    $Ter = 'S';
    $Qua = 'S';
    $Qui = 'S';
    $Sex = 'S';
    $Sab = 'S';
    $Dom = 'N';

    if (($Seg != 'S') and ($Ter != 'S') and ($Qua != 'S') and ($Qui != 'S') and ($Sex != 'S') and ($Sab != 'S') and ($Dom != 'S'))
        alert('Nenhum dia util cadastrado.');

    $diasemana = date("w", mktime(0,0,0,substr($Data, 3, 2),substr($Data, 0, 2),substr($Data, 6, 4)) );

    switch($diasemana) {
    case"0": $DiadaSemana = "Domingo"; break;
    case"1": $DiadaSemana = "Segunda-Feira"; break;
    case"2": $DiadaSemana = "Terça-Feira"; break;
    case"3": $DiadaSemana = "Quarta-Feira"; break;
    case"4": $DiadaSemana = "Quinta-Feira"; break;
    case"5": $DiadaSemana = "Sexta-Feira"; break;
    case"6": $DiadaSemana = "Sabado"; break;

    }
    
    $retorno = 0;

    //verifica qual o dia da semana e se é util
    if (($DiadaSemana == 'Segunda-Feira') and ($Seg == 'S')) {

        $retorno = 1;
    }else {
        if (($DiadaSemana == 'Terça-Feira') and ($Ter == 'S')) {

            $retorno = 1;
        }else {
            if (($DiadaSemana == 'Quarta-Feira') and ($Qua == 'S')) {

                $retorno = 1;
            }else {
                if (($DiadaSemana == 'Quinta-Feira') and ($Qui == 'S')) {

                    $retorno = 1;
                }else {
                    if (($DiadaSemana == 'Sexta-Feira') and ($Sex == 'S')) {
                        $retorno = 1;
                    }else {
                        if (($DiadaSemana == 'Sabado') and ($Sab == 'S')) {
                            $retorno = 1;
                        }else {
                            if (($DiadaSemana == 'Domingo') and ($Dom == 'S')) {
                                $retorno = 1;
                            }
                        }
                    }
                }
            }
        }
    }



    //{ -- Verifica Feriado -- }
    if ($retorno != 0) {

       /* $sql3 = "Select DataEvento from Calendario_Administrativo where DataEvento = Convert(DateTime,'" . $Data . "',103) and Tipo='F'";
        $rs3 = $DB->Execute($sql3);


        if ($rs3->RecordCount() > 0)
            $retorno = 0; */
    }

    return $retorno;
}

?>