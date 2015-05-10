<?php
	function verificar_url($url) 
	{
		// http://www.htmlstaff.org/ver.php?id=4355
		//return preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
		$urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
		if (eregi($urlregex, $url))
			return true;
		else return false;
	}
	
	
	function converte_para_url($String)
	{
		
		$Separador = "_";
		
		$String = trim($String); //Removendo espaços do inicio e do fim da string
		$String = strtolower($String); //Convertendo a string para minúsculas
		$String = strip_tags($String); //Retirando as tags HTML e PHP da string
		$String = eregi_replace("[[:space:]]", $Separador, $String); //Substituindo todos os espaços por $Separador
		
		$String = eregi_replace("[çÇ]", "c", $String); //Substituindo caracteres especiais pela letra respectiva
		$String = eregi_replace("[áÁäÄàÀãÃâÂ]", "a", $String);
		$String = eregi_replace("[éÉëËèÈêÊ]", "e", $String);
		$String = eregi_replace("[íÍïÏìÌîÎ]", "i", $String);
		$String = eregi_replace("[óÓöÖòÒõÕôÔ]", "o", $String);
		$String = eregi_replace("[úÚüÜùÙûÛ]", "u", $String);
		
		$String = eregi_replace("(\()|(\))", $Separador, $String); //Substituindo outros caracteres por "$Separador"
		$String = eregi_replace("(\/)|(\\\)", $Separador, $String);
		$String = eregi_replace("(\[)|(\])", $Separador, $String);
		$String = eregi_replace("[@#\$%&\*\+=\|º]", $Separador, $String);
		$String = eregi_replace("[;:'\"<>,\.?!_-]", $Separador, $String);
		$String = eregi_replace("[“”]", $Separador, $String);
		$String = eregi_replace("(ª)+", $Separador, $String);
		$String = eregi_replace("[`´~^°]", $Separador, $String);
		
		$String = eregi_replace("($Separador)+", $Separador, $String); //Removendo o excesso de "$Separador" por apenas um
		
		$String = substr($String, 0, 100); //Quebrando a string para um tamanho pré-definido
		
		$String = eregi_replace("(^($Separador)+)|(($Separador)+$)", "", $String); //Removendo o "$Separador" do inicio e fim da string

		return $String;
	}
	
	function verificar_email($email)
	{
	   $mail_correcto = 0;
	   //verifico umas coisas
	   if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
	   {
		  if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) 
			{
				//vejo se tem caracter .
				if (substr_count($email,".")>= 1)
				{
					//obtenho a terminação do dominio
					$term_dom = substr(strrchr ($email, '.'),1);
					//verifico que a terminação do dominio seja correcta
					if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) )
					{
						//verifico que o de antes do dominio seja correcto
						$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
						$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
						if ($caracter_ult != "@" && $caracter_ult != ".")
						{
							$mail_correcto = 1;
						}
					}
				}
			}
		}	
		if ($mail_correcto)
		   return 1;
		else
		   return 0;
	}
	
	
	function verificar_cpf($cpf)
	{
		for( $i = 0; $i < 10; $i++ ){
			if ( $cpf ==  str_repeat( $i , 11) or !preg_match("@^[0-9]{11}$@", $cpf ) or $cpf == "12345678909" )return false;       
			if ( $i < 9 ) $soma[]  = $cpf{$i} * ( 10 - $i );
				$soma2[] = $cpf{$i} * ( 11 - $i );           
		}
		if(((array_sum($soma)% 11) < 2 ? 0 : 11 - ( array_sum($soma)  % 11 )) != $cpf{9})return false;
		return ((( array_sum($soma2)% 11 ) < 2 ? 0 : 11 - ( array_sum($soma2) % 11 )) != $cpf{10}) ? false : true;
	}
?>