<? 	session_start();
	require("../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
    header("Content-type: text/html; charset=ISO-8859-1");
	$produto_id =      $_REQUEST["produto_id"];
    $quantidade = $_REQUEST['quantidade'];
    $SqlProduto = "select *from produto where id = '".$produto_id."'";
   	$rs= $DB->execute($SqlProduto);
    $Valor  = $rs->fields['valor'];
    $id = "Valor unitario:<font color='#FF0000'> R$ ".moeda($Valor)."</font> <input type='hidden' name='valor_unitario' value=".moeda($Valor)." id='valor_unitario' />  Valor total: <font color='#FF0000'> R$ ".moeda($Valor*$quantidade)."</font> <input type='hidden' name='valor_total' value=".moeda($Valor*$quantidade)." id='valor_total' />"; 
    echo $id; 
 ?>
