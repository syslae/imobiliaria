<?
   class Smtp{
         var $conn;
	 var $user;
	 var $pass;
	 var $debug = true;

	 /*Construtor da classe.
   	   Passe como parametro o host SMTP e a porta de conexao. */ 
	 function Smtp($host, $port){
		$this->conn = fsockopen($host, $port, $errno, $errstr, 30);
		$this->Put("EHLO $host");
	 }

	 /*Metodo para Autenticar
	   Autentica no server, ja convertendo os dados em base64.*/
	 function Auth(){
		$this->Put("AUTH LOGIN");
		$this->Put(base64_encode($this->user));
		$this->Put(base64_encode($this->pass));
 	 }

	 /*Metodo para enviar a msg.
	   Parametros: 'DE:', 'PARA:', 'ASSUNTO','MENSAGEM' */
 	 function Send($to, $from, $subject, $msg, $content_type = null){
   		$this->Auth();
		$this->Put("MAIL FROM: " . $from);
		$this->Put("RCPT TO: " . $to);
		$this->Put("DATA");
		if(isset($content_type)){
		    $this->Put($this->toHeader($to, $from, $subject, $content_type));
                }
		else{
		    $this->Put($this->toHeader($to, $from, $subject));
		}
		$this->Put("\n");
		$this->Put($msg);
		$this->Put(".");
   		$this->Close();
		if(isset($this->conn)){
			return true;
		}else{
			return false;
	  	}
	 }
	
	 /*Metodo Put
	   Passa valores para a conexao sock aberta no server.*/
         function Put($value){
		return fputs($this->conn, $value . "\n");
         }

	 /*Funcao toHeader
	   Prepara e monta o cabecalho da mensagem.
	   Aceita como parametro 'DE','PARA','ASSUNTO'
	   e 'CONTENT-TYPE'.
	   Metodo ja implementado na funcao Send.'*/
	 function toHeader($to, $from, $subject, $type = "text/plain"){
		$header  = "Message-Id: <". date('YmdHis').".". md5(microtime()).".". strtoupper($from) ."> \n";
		$header .= "From: <" . $from . "> \n";
		$header .= "To: <".$to."> \n";
		$header .= "Subject: ".$subject." \n";
		$header .= "Date: ". date('D, d M Y H:i:s O') ." \n";
		$header .= "Content-Type: ". $type . "; charset=iso-8859-1 \n";

		return $header;
	 }

	 /*Funcao Close
	   Fechaa a conexao sock apos o envio ser concluido.
	   Nao e necessario implementar, pois ja esta implementada 
	   na funcao Send*/
	 function Close(){
		$this->Put("QUIT");
		if($this->debug == true){
			while (!feof ($this->conn)) {
   				echo fgets($this->conn) . "<br>\n";
			}
		}
		return fclose($this->conn);
	 }

   }
?>
