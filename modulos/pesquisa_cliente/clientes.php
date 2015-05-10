<?php
	session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    require(DOMAIN_PATH."classes/class_anti_injection.php");
	header("Content-type: text/html; charset=ISO-8859-1");

    $anti = new AntiInjection();
    $q = strtolower($anti->get("q"));
    if (!$q) return;
    else $where = " and nome like '%$q%'";

    $sql = "SELECT id,nome,tipo,razao_social FROM cliente WHERE 1=1 $where and status=1";
    $rs = $DB->Execute($sql);

    while(!$rs->EOF)
    {
        $id = $rs->fields["id"];
        if($rs->fields["tipo"] == "F")
        {
         $descricao= $rs->fields["nome"];
        }
        else
        {
         $descricao=$rs->fields["razao_social"];
        }
        echo "$id-$descricao\n";
        $rs->MoveNext();
    }
?>
