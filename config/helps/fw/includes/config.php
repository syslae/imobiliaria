<?
// Root no servidor do framework
define ("rootfisico", "/var/www/fw/");

// Pasta do framework no servidor
define ("rootvirtual", "/brasilportais2/fw/");

// As linhas abaixo são a parte interessante do sistema, pra que usar chaves
// fixas se podemos definidas randomicamente a cada acesso ao sistema?
// assim, uma url usada por uma pessoa só será valida pra ela naquele acesso
if (!isset($_SESSION["cryptKey"])) $_SESSION["cryptKey"] = crypt(uniqid());
if (!isset($_SESSION["cryptKey2"])) $_SESSION["cryptKey2"] = crypt(uniqid());

Crypt::$chave = $_SESSION["cryptKey"];
Link::$chave =  $_SESSION["cryptKey2"];
?>
