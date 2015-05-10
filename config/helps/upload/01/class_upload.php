<?
set_time_limit(0);
include "funcoes.php";
class Upload
{
    var $arquivo = "";
    var $erro = array ( "0" => "upload executado com sucesso!",
                        "1" => "O arquivo é maior que o permitido pelo Servidor",
                        "2" => "O arquivo é maior que o permitido pelo formulario",
                        "3" => "O upload do arquivo foi feito parcialmente",    
                        "4" => "Não foi feito o upload do arquivo"
                       );
    var $largura = 800;
	var $altura = 100;
	
	var $larguraT = 60;
	var $alturaT = 45;
	
	var $thumbs = 0;
	
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
	  
    function Verifica_Upload()
    {
        $this->arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
        if(!is_uploaded_file($this->arquivo['tmp_name'])) {
            return false;
        }    
        $get = getimagesize($this->arquivo['tmp_name']);
        
        if($get["mime"] != "image/jpeg")
        {    
            echo "<span style=\"color: white; border: solid 1px; background: red;\">Esse foto nao é uma imagem valida</span>";
            exit;
        }
        return true;
    }

    function Envia_Arquivo()
    {
        if($this->Verifica_Upload()) {
            $this->gera_fotos();
            return true;        
        } else {
            echo "<span style=\"color: white; border: solid 1px; background: red;\">".$this->erro[$this->arquivo['error']]."</span>";
        }
    }
    
    function gera_fotos()
    {
        $diretorio = "fotos/";
        if(!file_exists($diretorio))
        {
            mkdir($diretorio);
        }
        
        $nome_foto  = "imagem_".time().".jpg";        
        $nome_thumb = "thumb_".time().".jpg";
        
                //determino uma resolução maxima e se a imagem for maior ela sera reduzida
        reduz_imagem($this->arquivo['tmp_name'], $this->largura, $this->altura, $diretorio.$nome_foto);        
                //passo o tamanho da thumbnail
        if ($this->thumbs<>0)
			reduz_imagem($this->arquivo['tmp_name'], $this->larguraT, $this->alturaT, $diretorio.$nome_thumb);
			
        echo "<span style=\"color: white; border: solid 1px; background: blue;\">".$this->erro[$this->arquivo['error']]."</span>";
         // -Banco de Dados - //

        /*$conexao = mysql_connect("localhost","root","");
        mysql_select_db("classificados");
        $text = $_POST['mensagem'];
        $sql = "insert INTO thumbs  Values ('','$nome_thumb','$nome_foto','$text')";
        $query = mysql_query($sql);
        
        mysql_close($conexao);
	*/
      
    }    
}

?>