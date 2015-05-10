<?
set_time_limit(0);
include "funcoesUpload.inc.php";
class Upload
{
    var $arquivo = "";
    var $erro = array ( "0" => "ok",
                        "1" => "O arquivo &eacute; maior que o permitido pelo Servidor",
                        "2" => "O arquivo &eacute; maior que o permitido pelo formulario",
                        "3" => "O upload do arquivo foi feito parcialmente",    
                        "4" => "N&atilde;o foi feito o upload do arquivo"
                       );

    var $largura = 800;
	var $altura = 100;
	
	var $larguraT = 60;
	var $alturaT = 45;
	
	var $thumbs = 0;
	var $campoUpload = 'foto';
	var $pastaUpload = '_padrao';
	
	var $nomeFoto;
	var $nomeThumbs;
	
	var $erro2 = NULL;
	
	function setCampoUpload($campoUpload)
	{
		$this->campoUpload=$campoUpload;
	}
	
	function setPastaUpload($pastaUpload)
	{
		$this->pastaUpload=$pastaUpload;
	}
	
	function setAltura($altura)
	{
		$this->altura=$altura;
	}
	
	function setLargura($largura)
	{
		$this->largura=$largura;
	}
	
	function setAlturaT($alturaT)
	{
		$this->alturaT=$alturaT;
	}
	
	function setLarguraT($larguraT)
	{
		$this->larguraT=$larguraT;
	}
	
	
	function setThumbs($thumbs)
	{
		$this->thumbs=$thumbs;
	}
	 
	
	function setNomeFoto($nome)
	{
		$this->nomeFoto = $nome;
	}
	function getNomeFoto()
	{
		return $this->nomeFoto;
	}
	
	function setNomeThumbs($nome)
	{
		$this->nomeThumbs = $nome;
	}
	function getNomeThumbs()
	{
		return $this->nomeThumbs;
	}
	
	function setErro2($erro2)
	{
		$this->erro2 = $erro2;
	}
	function getErro2()
	{
		return $this->erro2;
	}
	
	
	
    function Verifica_Upload()
    {
	
	    $this->arquivo = isset($_FILES[$this->campoUpload]) ? $_FILES[$this->campoUpload] : FALSE;
        if(!is_uploaded_file($this->arquivo['tmp_name'])) 
		{
            return false;
        }    
        $get = getimagesize($this->arquivo['tmp_name']);
      
        if($get["mime"] != "image/jpeg")
        {    
			$this->setErro2('Essa foto n&atilde;o &eacute; uma imagem v&aacute;lida');
            return false;
        }
        return true;
    }

    function Envia_Arquivo()
    {
        if($this->Verifica_Upload())
		{
			$this->gera_fotos();
            return true;        
        }
		else
		{
			if (empty($this->setErro2) and $this->arquivo['error']<>0)
				$this->setErro2($this->erro[$this->arquivo['error']]);
        }
    }
    
    function gera_fotos()
    {
	if(!isset($this->nomeFoto)){
		$diretorio = "../webroot/img_sistema/".$this->pastaUpload.'/';
				//verifica se a apsta é albunsfotos
				$pasta_teste=explode("/",$this->pastaUpload); //alterei aqui
				
				
					if($pasta_teste[0]=='albumfotos'){
							 if(!file_exists("../webroot/img_sistema/$pasta_teste[0]"))
									{
								mkdir("../webroot/img_sistema/$pasta_teste[0]");
										chmod("../webroot/img_sistema/$pasta_teste[0]",777);
									}
				//fim do criar pasta do foto album	
					}
        if(!file_exists($diretorio))
        {
            mkdir($diretorio);
        }
		       
		$time = time();
		
        $this->nomeFoto   = $this->nome($diretorio, $time, "imagem_");        
        $this->nomeThumbs = $this->nome($diretorio, $time, "thumb_");
        }
                //determino uma resolução maxima e se a imagem for maior ela sera reduzida
			
        reduz_imagem($this->arquivo['tmp_name'], $this->largura, $this->altura, $diretorio.$this->nomeFoto);    
		
                //passo o tamanho da thumbnail
        if ($this->thumbs<>0)
			reduz_imagem($this->arquivo['tmp_name'], $this->larguraT, $this->alturaT, $diretorio.$this->nomeThumbs);
			
		$this->setErro2($this->erro[$this->arquivo['error']]);
		 print_r($erro2);
      
    }
	
	function nome($diretorio, $time, $prefixo)
	{
		// Gera um nome automatico para a imagem
		//$temp = substr(md5(uniqid($time)), 0, 10);
		$temp = substr(md5($time), 0, 10);
		$imagem_nome = $prefixo.$temp . ".jpg";
		
		// Verifica se o arquivo ja existe, caso positivo, chama essa funcao novamente
		if(file_exists($diretorio . $imagem_nome))
		{
			$imagem_nome = nome($diretorio, $time, $prefixo);
		}
		return $imagem_nome;
	} 
}

?>