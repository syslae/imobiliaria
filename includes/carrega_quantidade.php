<? 	session_start();
	require("../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
    require("../includes/funcoes.php");
    header("Content-type: text/html; charset=ISO-8859-1");
	$produto_id =      $_GET["id"];
	$resultado = QuantProduto($produto_id);
	if($resultado == 0 )
	{
		$id = "<input name='quantidade' type='text'  id='quantidade' size='4' maxlength='4' disabled='disabled' /> <font
	 	color='#FF0000'>Não disponivel. </font>"; 
	}
	else
	{
		$id = "<input name='quantidade' type='text'  id='quantidade'   size='4' maxlength='4' onblur='carrega_quantidade()' /> <font
	 	color='#FF0000'>Disponivel: ".$resultado."  </font> <input type='hidden' name='disponivel' value=".$resultado." id='disponivel' /><input type='hidden' name='produto_id' value=".$produto_id." id='produto_id' />"; 
 	}
 	echo $id;
 ?>
