<?php
  include ("smtp.class.php");
  $host = "smtp.inforgeneses.com.br"; /*host do servidor SMTP */
  $mail = "acessosmtp@inforgeneses.com.br";//o endere�o de e-mail deve ser v�lido.
  $senha = "d0c5v35t";

  /* Configura��o da classe.e smtp.class.php */
  $smtp = new Smtp($host, 587);
  $smtp->user = $mail; /*usuario do servidor SMTP */
  $smtp->pass = $senha; /* senha do usuario do servidor SMTP*/
  $smtp->debug = true; /*ativa a autenticacao SMTP */

  /* Prepara a mensagem para ser enviada. */
  $from = $mail;
  $to = $_POST['destino'];
  $subject = "Teste de envio Autenticado";
  $msg = "<b>Esta mensagem � um teste da <font color=red>Locaweb.</font><</b><br />";
  $msg .= "Caso tenha recebido esta mensagem por engano, por favor desconsidere.";

  /* faz o envio da mensagem */
  $enviou = $smtp->Send($to, $from, $subject, $msg, "text/html") ? 'enviou' : 'falhou';
  header('Location:index.php?status='.$enviou, "-r".$from);
?>
