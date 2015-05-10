<?
  	   
  require("../config/define.php");
  require(DOMAIN_PATH."config/conexaoAr.php");;


  include ("smtp.class.php");

		  //$host = "smtp.moskanasopa.com.br"; /*host do servidor SMTP */
		//  $mail = "naoresponde@moskanasopa.com.br";//o endereço de e-mail deve ser válido.
	//	  $senha = "12345678i";

		  $host = "Smtp01.academusportal.com.br"; /*host do servidor SMTP */
		  $mail = "naoresponde@moskanasopa.com.br";//o endereço de e-mail deve ser válido.
     	  $senha = "Tgb765";

  
	     //Dados Email
          $de = "nãoresponder@gmail.com";
	      $assunto =  "AVISO DE CONTRATO";
          $assunto = "CONTRATO";
	      /* Configuração da classe.e smtp.class.php */
	      $smtp = new Smtp($host, 587);
	      $smtp->user = $mail; /*usuario do servidor SMTP */
	      $smtp->pass = $senha; /* senha do usuario do servidor SMTP*/
	      $smtp->debug = true; /*ativa a autenticacao SMTP */
          $email = "laecyomarcello@gmail.com"; 


            $mensagem = "";
		
		      $mensagem .= "Agradece SYSLAE - SISTEMAS<br>";
			$enviou = $smtp->Send($email, $mail, $assunto, $mensagem, "text/html") ? 'enviou' : 'falhou';	
		   	
	    
          		
?>