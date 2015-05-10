<? 
  	session_start();
   	require("../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
  	$Descricao = $_POST["nomeproduto"];
   $sql = "select id,descricao_reduzida from produto where descricao_reduzida= '$Descricao'";
	$rs= $DB->execute($sql);
	$Id = $rs->fields['id']."-".$rs->fields['descricao_reduzida'];
 echo $Id;

 
 
 
 ?>