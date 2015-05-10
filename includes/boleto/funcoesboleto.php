<?php 

// -------------------------------------- Gera o Código de Barra -------------------------------------
function fbarcode($valor)
{
  $fino = 1 ;
  $largo = 3 ;
  $altura = 31 ;

  $barcodes[0] = "00110" ;
  $barcodes[1] = "10001" ;
  $barcodes[2] = "01001" ;
  $barcodes[3] = "11000" ;
  $barcodes[4] = "00101" ;
  $barcodes[5] = "10100" ;
  $barcodes[6] = "01100" ;
  $barcodes[7] = "00011" ;
  $barcodes[8] = "10010" ;
  $barcodes[9] = "01010" ;
  for($f1=9;$f1>=0;$f1--){ 
    for($f2=9;$f2>=0;$f2--){  
      $f = ($f1 * 10) + $f2 ;
      $texto = "" ;
      for($i=1;$i<6;$i++){ 
        $texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
      }
      $barcodes[$f] = $texto;
    }
  }
  
//Desenho da barra
echo "<img src=p.gif width=$fino height=$altura border=0><img 
src=b.gif width=$fino height=$altura border=0><img 
src=p.gif width=$fino height=$altura border=0><img 
src=b.gif width=$fino height=$altura border=0><img ";

$texto = $valor ;
if(bcmod(strlen($texto),2) <> 0){
	$texto = "0" . $texto;
}

// Draw dos dados
while (strlen($texto) > 0) {
  $i = round(esquerda($texto,2));
  $texto = direita($texto,strlen($texto)-2);
  $f = $barcodes[$i];
  for($i=1;$i<11;$i+=2){
    if (substr($f,($i-1),1) == "0") {
      $f1 = $fino ;
    }else{
      $f1 = $largo ;
    }

echo "src=p.gif width=$f1 height=$altura border=0><img ";

    if (substr($f,$i,1) == "0") {
      $f2 = $fino ;
    }else{
      $f2 = $largo ;
    }

echo "src=b.gif width=$f2 height=$altura border=0><img ";

  }
}

// Draw guarda final

echo "src=p.gif width=$largo height=$altura border=0><img 
src=b.gif width=$fino height=$altura border=0><img 
src=p.gif width=1 height=$altura border=0> ";

} //Fim da função

function esquerda($entra,$comp){
	return substr($entra,0,$comp);
}

function direita($entra,$comp){
	return substr($entra,strlen($entra)-$comp,$comp);
}

// ----------------------------------Calcula o Dígito Verificador -------------------------------------
function calcDigVerif($numero)
{
   $numero = trim($numero);
   $digito = 0;
   $j = 2;
   for ($i = strlen($numero)-1; $i >= 0; $i--)
   {
     $n = ord($numero[$i]) - ord('0'); 
	 $cod = ($n % 10) * $j;
	 $digito = $digito + ($cod % 10) + floor($cod / 10);
	 if ($j == 2)
	   $j = 1;
	 else
	   $j = 2;
   }
   $digito = $digito % 10; 
   if ($digito != 0)
	 $result = strval(10 - $digito);
   else
	 $result = '0';
   
   return $result;  
}

// -------------------------------Retorna Representação Numérica do Banco --------------------------------- 	
function GeraRepNumericaBanco($codBarra, $idBanco)
{		
 
  switch ($idBanco)
  {
      case 'PC' :
          $campo1 = substr($codBarra,0,11);
          $campo2 = substr($codBarra,11,11);
          $campo3 = substr($codBarra,22,11);
          $campo4 = substr($codBarra,33,11);

          $dv1 = DAC10($campo1);
          $dv2 = DAC10($campo2);
          $dv3 = DAC10($campo3);
          $dv4 = DAC10($campo4);

          $repNumerica = "$campo1 $dv1 $campo2 $dv2 $campo3 $dv3 $campo4 $dv4";
          return $repNumerica;
          break;

    case 'CS' : 
              $campo1 = substr($codBarra,0,4).substr($codBarra,19,5); 
              $campo2 = substr($codBarra,24,10); 
  		      $campo5 = substr($codBarra,5,14); 
	break;
			
	case 'CR' : 
              $campo1 = substr($codBarra,0,4).substr($codBarra,19,5);
              $campo2 = substr($codBarra,24,10);
  		      $campo5 = substr($codBarra,5,14);				  			
	break;
			  
	case 'US' : 
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,1).substr($codBarra,20,4);
              $campo2 = substr($codBarra,24,3).substr($codBarra,27,2).substr($codBarra,29,5);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);
	break;
			  			  
	case 'BB' :
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,5);
              $campo2 = substr($codBarra,24,10);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);
	break;
			  
	case 'RC' : 
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,1).substr($codBarra,20,4);
              $campo2 = substr($codBarra,24,3).substr($codBarra,27,2).substr($codBarra,29,5);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);		  
	break;
			  
	case 'RS' : 
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,1).substr($codBarra,20,4);
              $campo2 = substr($codBarra,24,3).substr($codBarra,27,2).substr($codBarra,29,5);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);		  
	break;

	case 'BR':
	case 'BI':	
				$codigo = $codBarra;		  
              	$p1 = substr($codigo, 0, 4);							// Numero do banco + Carteira
				$p2 = substr($codigo, 19, 5);						// 5 primeiras posições do campo livre
				$p3 = modulo_10("$p1$p2");						// Digito do campo 1
				$p4 = "$p1$p2$p3";								// União
				$campo1 = substr($p4, 0, 5).'.'.substr($p4, 5);
		
				// 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
				// e livre e DV (modulo10) deste campo
				$p1 = substr($codigo, 24, 10);						//Posições de 6 a 15 do campo livre
				$p2 = modulo_10($p1);								//Digito do campo 2	
				$p3 = "$p1$p2";
				$campo2 = substr($p3, 0, 5).'.'.substr($p3, 5);
		
				// 3. Campo composto pelas posicoes 16 a 25 do campo livre
				// e livre e DV (modulo10) deste campo
				$p1 = substr($codigo, 34, 10);						//Posições de 16 a 25 do campo livre
				$p2 = modulo_10($p1);								//Digito do Campo 3
				$p3 = "$p1$p2";
				$campo3 = substr($p3, 0, 5).'.'.substr($p3, 5);
		
				// 4. Campo - digito verificador do codigo de barras
				$campo4 = substr($codigo, 4, 1);
		
				// 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
				// indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
				// tratar de valor zerado, a representacao deve ser 000 (tres zeros).
				$p1 = substr($codigo, 5, 4);
				$p2 = substr($codigo, 9, 10);
				$campo5 = "$p1$p2";		  
				$repNumerica = "$campo1 $campo2 $campo3 $campo4 $campo5";
	break;

	case 'SR' : 
				$codigo = $codBarra;
              	$p1 = substr($codigo, 0, 4);
				$p2 = substr($codigo, 19, 5);
				$p3 = modulo_10("$p1$p2");
				$p4 = "$p1$p2$p3";
				$p5 = substr($p4, 0, 5);
				$p6 = substr($p4, 5);
				$campo1 = "$p5.$p6";
		
				// 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
				// e livre e DV (modulo10) deste campo
				$p1 = substr($codigo, 24, 10);
				$p2 = modulo_10($p1);
				$p3 = "$p1$p2";
				$p4 = substr($p3, 0, 5);
				$p5 = substr($p3, 5);
				$campo2 = "$p4.$p5";
		
				// 3. Campo composto pelas posicoes 16 a 25 do campo livre
				// e livre e DV (modulo10) deste campo
				$p1 = substr($codigo, 34, 10);
				$p2 = modulo_10($p1);
				$p3 = "$p1$p2";
				$p4 = substr($p3, 0, 5);
				$p5 = substr($p3, 5);
				$campo3 = "$p4.$p5";
		
				// 4. Campo - digito verificador do codigo de barras
				$campo4 = substr($codigo, 4, 1);
		
				// 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
				// indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
				// tratar de valor zerado, a representacao deve ser 000 (tres zeros).
				$p1 = substr($codigo, 5, 4);
				$p2 = substr($codigo, 9, 10);
				$campo5 = "$p1$p2";
		
				$repNumerica = "$campo1 $campo2 $campo3 $campo4 $campo5"; 
	break;

	case 'IT' :

		$codigo = $codBarra;

		// campo 1
        $banco    = substr($codigo,0,3);
        $moeda    = substr($codigo,3,1);
        $ccc      = substr($codigo,19,3);
		$ddnnum   = substr($codigo,22,2);
		$dv1      = modulo_10($banco.$moeda.$ccc.$ddnnum);
		// campo 2
		$resnnum  = substr($codigo,24,6);
		$dac1     = substr($codigo,30,1);//modulo_10($agencia.$conta.$carteira.$nnum);
		$dddag    = substr($codigo,31,3);
		$dv2      = modulo_10($resnnum.$dac1.$dddag);
		// campo 3
		$resag    = substr($codigo,34,1);
		$contadac = substr($codigo,35,6); //substr($codigo,35,5).modulo_10(substr($codigo,35,5));
		$zeros    = substr($codigo,41,3);
		$dv3      = modulo_10($resag.$contadac.$zeros);
		// campo 4
		$dv4      = substr($codigo,4,1);
		// campo 5
        $fator    = substr($codigo,5,4);
        $valor    = substr($codigo,9,10);
		
        $campo1 = substr($banco.$moeda.$ccc.$ddnnum.$dv1,0,5) . '.' . substr($banco.$moeda.$ccc.$ddnnum.$dv1,5,5);
        $campo2 = substr($resnnum.$dac1.$dddag.$dv2,0,5) . '.' . substr($resnnum.$dac1.$dddag.$dv2,5,6);
        $campo3 = substr($resag.$contadac.$zeros.$dv3,0,5) . '.' . substr($resag.$contadac.$zeros.$dv3,5,6);
        $campo4 = $dv4;
        $campo5 = $fator.$valor;
		
        $repNumerica =  "$campo1 $campo2 $campo3 $campo4 $campo5"; 

	break;
	
	case 'HS' :
		$codigo = $codBarra;
		// 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posições
		// do campo livre e DV (modulo10) deste campo
		$campo1 = substr($codigo,0,4) . substr($codigo,19,5);
		$campo1 = $campo1 . modulo_10($campo1);
		$campo1 = substr($campo1,0,5) . '.' . substr($campo1,5,5);
		
		// 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
		// e livre e DV (modulo10) deste campo
		$campo2 = substr($codigo,24,2) . substr($codigo,26,8);
		$campo2 = $campo2 . modulo_10($campo2);
		$campo2 = substr($campo2,0,5) . '.' . substr($campo2,5,6);
		
		// 3. Campo composto pelas posicoes 16 a 25 do campo livre
		// e livre e DV (modulo10) deste campo
		$campo3 = substr($codigo,34,5) . substr($codigo,39,4) . substr($codigo,43,1);
		$campo3 = $campo3 . modulo_10($campo3);
		$campo3 = substr($campo3,0,5) . '.' . substr($campo3,5,6);
	
		// 4. Campo - digito verificador do codigo de barras
		$campo4 = substr($codigo, 4, 1);
		
		// 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
		// indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
		// tratar de valor zerado, a representacao deve ser 000 (tres zeros).
		$campo5 = substr($codigo, 5, 4) . substr($codigo, 9, 10);
		
		$repNumerica = "$campo1 $campo2 $campo3 $campo4 $campo5"; 
		
	break;
	
	case 'BN' :
		$codigo = $codBarra;
		$campo1 = substr($codBarra,0,4).substr($codBarra,19,5);
		$DV = modulo_10($campo1);
		$campo2 = substr($codBarra,24,10);
		$DV1 = modulo_10($campo2);
		
		$campo3 = substr($codigo,34,10);
		$DV2 = modulo_10($campo3);
		$campo4 = substr($codigo,4,1);
		
		$campo5 = substr($codBarra,5,14);
		
		$repNumerica = substr($campo1, 0, 5). '.' . substr($campo1,5,4) . $DV . ' ' .
		substr($campo2,0,5) . '.' . substr($campo2,5,5) . $DV1 . ' ' .
		substr($campo3,0,5) . '.' . substr($campo3,5,5) . $DV2 . ' ' .
		$campo4 . ' ' . $campo5;
		
	break;
	
	case 'BS':
			$codigo = $codBarra;
			// 1. Primeiro Grupo - composto pelo código do banco, código da moéda, Valor Fixo "9"
			// e 4 primeiros digitos do PSK (codigo do cliente) e DV (modulo10) deste campo
			$campo1 = substr($codigo,0,3) . substr($codigo,3,1) . substr($codigo,19,1) . substr($codigo,20,4);
			$campo1 = $campo1 . modulo_10($campo1);
		  	$campo1 = substr($campo1, 0, 5).'.'.substr($campo1, 5);

			// 2. Segundo Grupo - composto pelas 3 últimas posiçoes do PSK e 7 primeiros dígitos do Nosso Número
			// e DV (modulo10) deste campo
			$campo2 = substr($codigo,24,10);
			$campo2 = $campo2 . modulo_10($campo2);
  			$campo2 = substr($campo2, 0, 5).'.'.substr($campo2, 5);

			// 3. Terceiro Grupo - Composto por : Restante do Nosso Numero (6 digitos), IOS, Modalidade da Carteira
			// e DV (modulo10) deste campo
			$campo3 = substr($codigo,34,10);
			$campo3 = $campo3 . modulo_10($campo3);
  			$campo3 = substr($campo3, 0, 5).'.'.substr($campo3, 5);

			// 4. Campo - digito verificador do codigo de barras
			$campo4 = substr($codigo, 4, 1);
	
			// 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
			// indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
			// tratar de valor zerado, a representacao deve ser 0000000000 (dez zeros).
			$campo5 = substr($codigo, 5, 4) . substr($codigo, 9, 10);
	
			$repNumerica = "$campo1 $campo2 $campo3 $campo4 $campo5"; 
			
		break;

  }
  
  if ( ($idBanco != 'BR') && ($idBanco != 'BI') && ($idBanco != 'SR') && ($idBanco != 'IT') && ($idBanco != 'HS') && ($idBanco != 'BS') && ($idBanco != 'BN') ){  
  
	  $campo3 = substr($codBarra,34,10);
      $campo4 = substr($codBarra,4,1); 
	  
	  $dv1 = calcDigVerif($campo1);
	  $dv2 = calcDigVerif($campo2);    
	  $dv3 = calcDigVerif($campo3);
      
      //echo $campo1.'<br>'.$campo2.'<br>'.$campo3; exit();
	  $repNumerica1 = substr($campo1,0,5).'.'.substr($campo1,5,4).$dv1.' ';
	  $repNumerica2 = substr($campo2,0,5).'.'.substr($campo2,5,5).$dv2.' ';
	  $repNumerica3 = substr($campo3,0,5).'.'.substr($campo3,5,5).$dv3.' ';
      
	  $repNumerica = $repNumerica1.$repNumerica2.$repNumerica3.$campo4.' '.$campo5;
 }
  
  return $repNumerica;  
}

function modulo_10($num) { 
		$numtotal10 = 0;
        $fator = 2;

        // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo (falor 10)
            // 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Itaú
            $temp = $numeros[$i] * $fator; 
            $temp0=0;
            foreach (preg_split('//',$temp,-1,PREG_SPLIT_NO_EMPTY) as $k=>$v){ $temp0+=$v; }
            $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2; // intercala fator de multiplicacao (modulo 10)
            }
        }
		
        // várias linhas removidas, vide função original
        // Calculo do modulo 10
        $resto = $numtotal10 % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }
		
        return $digito;
		
}


?>