<?php 

// -------------------------------------- Gera o Código de Barra -------------------------------------
function fbarcode($valor)
{
  $fino = 1 ;
  $largo = 3 ;
  $altura = 50 ;

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
    case 'CS' : 
              $campo1 = substr($codBarra,0,4).substr($codBarra,19,5); 
              $campo2 = substr($codBarra,24,10); 
  		      $campo5 = substr($codBarra,5,14); 			  
			
	case 'CR' : 
              $campo1 = substr($codBarra,0,4).substr($codBarra,19,5);
              $campo2 = substr($codBarra,24,10);
  		      $campo5 = substr($codBarra,5,14);				  			
			  
	case 'US' : 
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,1).substr($codBarra,20,4);
              $campo2 = substr($codBarra,24,3).substr($codBarra,27,2).substr($codBarra,29,5);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);
			  			  
	case 'BB' :
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,5);
              $campo2 = substr($codBarra,24,10);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);
			  
	case 'RC' : 
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,1).substr($codBarra,20,4);
              $campo2 = substr($codBarra,24,3).substr($codBarra,27,2).substr($codBarra,29,5);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);		  
			  
	case 'RS' : 
              $campo1 = substr($codBarra,0,3).substr($codBarra,3,1).substr($codBarra,19,1).substr($codBarra,20,4);
              $campo2 = substr($codBarra,24,3).substr($codBarra,27,2).substr($codBarra,29,5);
  		      $campo5 = substr($codBarra,5,4).substr($codBarra,9,10);		  
  }

  $campo3 = substr($codBarra,34,10);
  $campo4 = substr($codBarra,4,1);
  
  $dv1 = calcDigVerif($campo1);
  $dv2 = calcDigVerif($campo2);    
  $dv3 = calcDigVerif($campo3);
  
  $repNumerica1 = substr($campo1,0,5).'.'.substr($campo1,5,4).$dv1.' ';
  $repNumerica2 = substr($campo2,0,5).'.'.substr($campo2,5,5).$dv2.' ';
  $repNumerica3 = substr($campo3,0,5).'.'.substr($campo3,5,5).$dv3.' ';
  $repNumerica = $repNumerica1.$repNumerica2.$repNumerica3.$campo4.' '.$campo5;
  
  return $repNumerica;  
}

?>