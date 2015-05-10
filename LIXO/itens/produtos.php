<?php
	session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	header("Content-type: text/html; charset=ISO-8859-1");
$q = strtolower($_GET["q"]);
if (!$q) return;


$sql = "SELECT id,descricao FROM produto WHERE status=1";
$rs = $DB->Execute($sql);

while(!$rs->EOF)
{
	$id=$rs->fields["id"];
    $descricao=$rs->fields["descricao"];
	echo "$descricao\n";
	$rs->MoveNext();

}





?>
