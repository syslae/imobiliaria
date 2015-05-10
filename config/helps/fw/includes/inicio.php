<?
header('Content-type: text/html; charset=UTF-8');
@session_start();

// incluimos as classes e os outros arquivos
include "funcoes.php";
include "classes/link.php";
include "config.php";

// agora tratamos a URL atual
Link::trataQuery();
?>
