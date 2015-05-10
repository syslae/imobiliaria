<?php

    $taxa_boleto = 0.00;
    $data_venc = $vencimento;
    $valor_cobrado = $valorDoc ;
    $valor_cobrado = str_replace(",", ".",$valor_cobrado);
    $valor_boleto = number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

    $tam_n_num = strlen($nossoNumero);

	switch ($tam_n_num)
	{
		case 1:
			$nossoNumero = "00000000".$nossoNumero;                    
			break;
		case 2:
			$nossoNumero = "0000000".$nossoNumero;
			break;	
		case 3:
			$nossoNumero = "000000".$nossoNumero;
			break;
		case 4:
			$nossoNumero = "00000".$nossoNumero;
			break;
		case 5:
			$nossoNumero = "0000".$nossoNumero;
			break;
		case 6:
			$nossoNumero = "000".$nossoNumero;
			break;
		case 7:
			$nossoNumero = "00".$nossoNumero;
			break;
		case 8:
			$nossoNumero = "0".$nossoNumero;
			break;
	}

	$dadosboleto["nosso_numero1"] = "000"; // tamanho 3
	$dadosboleto["nosso_numero_const1"] = "2"; //constanto 1 , 1=registrada , 2=sem registro
	$dadosboleto["nosso_numero2"] = "000"; // tamanho 3
	$dadosboleto["nosso_numero_const2"] = "4"; //constanto 2 , 4=emitido pelo proprio cliente
	//$dadosboleto["nosso_numero3"] = "000000019"; // tamanho 9
	$dadosboleto["nosso_numero3"] = $nossoNumero; // tamanho 9

    $dadosboleto["numero_documento"] = $nossoNumero;	// Num do pedido ou nosso numero
    $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
    $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
    // Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
    $dadosboleto["valor_boleto"] = $valorDoc;
	$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto

    $dadosboleto["quantidade"] = "";
    $dadosboleto["valor_unitario"] = "";
    $dadosboleto["aceite"] = "N";		
    $dadosboleto["uso_banco"] = ""; 	
    $dadosboleto["especie"] = "R$";
    $dadosboleto["especie_doc"] = "DM";

    // DADOS DO BOLETO
    // ESTE VARI�VEL codCedente VEM DOS PARAMETROS DO BANCO 
    $vetCodCedente = split("/",$codCedente);//sintaxe split("parametro",$vari�vel)
    //
    $dadosboleto["agencia"] = $vetCodCedente[0]; // Num da agencia, sem digito
    $dadosboleto["conta"] = $vetCodCedente[1]; 	// Num da conta, sem digito
	$dadosboleto["conta_cedente"] = $vetCodCedente[1];
    $dadosboleto["convenio"] = $vetCodCedente[1];  // Num do conv�nio - REGRA: 6 ou 7 ou 8 d�gitos
    $dadosboleto["contrato"] = "contrato"; // Num do seu contrato
    $dadosboleto["carteira"] = $idBanco;  // C�digo da Carteira 18 - 17 ou 11
    $dadosboleto["variacao_carteira"] = $variacao_carteira;  // Varia��o da Carteira, com tra�o (opcional)

    // TIPO DO BOLETO
    // REGRA: 8 p/ Conv�nio c/ 8 d�gitos, 7 p/ Conv�nio c/ 7 d�gitos, ou 6 se Conv�nio c/ 6 d�gitos
    $dadosboleto["formatacao_convenio"] = "7";
    // REGRA: Usado apenas p/ Conv�nio c/ 6 d�gitos: informe 1 se for NossoN�mero de at� 5 d�gitos ou 2 para op��o de at� 17 d�gitos
    $dadosboleto["formatacao_nosso_numero"] = "2"; 

?>