<?     
	session_start();
   	require("../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
$pEstado = $_POST["estado"];
$sql1 = "SELECT a.id, a.nome FROM  cidade  a WHERE a.id_estado = ".$pEstado." ORDER BY a.nome";
$sql = $DB->Execute($sql1);
$row = $sql->RecordCount();
if($row) 
{ 
	$xml  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
    $xml .= "<cidades>\n";               
   	
	 while(!$sql->EOF)
	 {   
		  $codigo    =  $sql->fields['id'];
		  $descricao =  $sql->fields['nome'];
		  $xml .= "<cidade>\n";     
		  $xml .= "<codigo>".$codigo."</codigo>\n";                  
		  $xml .= "<descricao>".$descricao."</descricao>\n";         
	      $xml .= "</cidade>\n";    
		 $sql->MoveNext(); 
	}
      $xml.= "</cidades>\n";
      Header("Content-type: application/xml; charset=iso-8859-1"); }
echo $xml;            

