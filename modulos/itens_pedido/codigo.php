<?php
	session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	header("Content-type: text/html; charset=ISO-8859-1");
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "SELECT id,codigo FROM produto WHERE status=1";
$rs = $DB->Execute($sql);

while(!$rs->EOF)
{
	$id=$rs->fields["id"];
    $descricao=$rs->fields["codigo"];
	echo "$descricao\n";
	$rs->MoveNext();
}
?>
