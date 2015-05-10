<?
  	   
  require("../config/define.php");
  require(DOMAIN_PATH."config/conexaoAr.php");;

  include ("smtp.class.php");
  $host = "smtp.inforgeneses.com.br"; /*host do servidor SMTP */
  $mail = "acessosmtp@inforgeneses.com.br";//o endereço de e-mail deve ser válido.
  $senha = "d0c5v35t";


 //$host = "smtp.medleyacademia.net"; /*host do servidor SMTP */
// $mail = "syslae@medleyacademia.net";//o endereço de e-mail deve ser válido.
// $senha = "lae66141";







    $sql = "select *from data";
	$rs = $DB->Execute($sql);
	$QuantidadeDiasMandarEmail =   $rs->fields['descricao'];


    $sql10 = "select *from espaco_fisico";
	$rs10 = $DB->Execute($sql10);


    while(!$rs10->EOF)
  {
    
	$empresa_id = $rs10->fields['id'];
    $email 		= $rs10->fields['email'];
    $sql3 = "select *from vis_email where QuantidadeDias > 0 and QuantidadeDias <= $QuantidadeDiasMandarEmail and empresa_id = $empresa_id";
    $rs2 = $DB->Execute($sql3);
    $NumLinhas = $rs2->RecordCount(); 
	  

		  if($NumLinhas >0)
		{
	     //Dados Email
          $de = "nãoresponder@gmail.com";
	      $assunto =  "AVISO DE CONTRATO";
          //DADOS SMTP
          $smtp = "smtp.inforgeneses.com.br";
          $usuario = "acessosmtp@inforgeneses.com.br";
          $senha = "d0c5v35t";
          $assunto = "CONTRATO";
	      /* Configuração da classe.e smtp.class.php */
	      $smtp = new Smtp($host, 587);
	      $smtp->user = $mail; /*usuario do servidor SMTP */
	      $smtp->pass = $senha; /* senha do usuario do servidor SMTP*/
	      $smtp->debug = true; /*ativa a autenticacao SMTP */


            $mensagem = "";
		
		       while(!$rs2->EOF)
		       {
		            if($rs2->fields['QuantidadeDias'] <= $QuantidadeDiasMandarEmail)
		            {
		               	
		                $mensagem .="O cliente ".$rs2->fields['nome_fantasia_cliente']." do contrato de numero ".$rs2->fields['numero_contrato']." esta faltando ".$rs2->fields['QuantidadeDias']." dias para vencer o contrato.<br>";
		            }
		
		              $rs2->MoveNext();
				}
			  $mensagem .= "Agradece SYSLAE - SISTEMAS<br>";
			$enviou = $smtp->Send($email, $mail, $assunto, $mensagem, "text/html") ? 'enviou' : 'falhou';	
		   	
	    }
	$rs10->MoveNext();
}
          		
?>