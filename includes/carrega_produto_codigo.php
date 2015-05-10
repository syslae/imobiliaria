<? 
  	session_start();
   	require("../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    $Codigo = $_POST["nomeproduto"];
    $sql = "select id,descricao_reduzida from produto where codigo = '$Codigo'";
	$rs= $DB->execute($sql);
	$Id = $rs->fields['id']."-".$rs->fields['descricao_reduzida'];
 echo $Id;
 
?>