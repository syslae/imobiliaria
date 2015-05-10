<?
/*
$url = 'http://www.rupertlustosa.com.br/index/5';
 $urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
if (eregi($urlregex, $url)) {echo "good";} else {echo "bad";}

*/
?>
<?php
$textoValidacaoController = 'aa dfd foto jfhsjkfh jkfhsfjkhfjkhf shfjkh prefeito kjsfhjksfh thumbsa  carro melancia foto s';

$foto = strpos($textoValidacaoController, 'foto');
$fotop = strpos($textoValidacaoController, 'fotop');
$fotog = strpos($textoValidacaoController, 'fotog');

/* or 
	$foto1===true or 
	$foto2===true or 
	$foto3===true or 
	$fotop===true or 
	$fotog===true or 
	$thumbs===true or 
	$miniatura===true*/
echo '->'.$foto.'<-';
if ($foto===true)
{	
	echo ':-)';
}
else echo 'nao tem';
exit;
if ($foto===true or $fotop===true or $fotog===true)
{
	echo 'tem';
}
else
{
	echo 'nao tem';
}

// Note o uso de ===.  Simples == não funcionaria como esperado
// por causa da posição de 'a' é 0 (primeiro) caractere.
/*if ($pos === false) {
    echo "A string '$findme' não foi encontrada na string '$mystring'";
} else {
    echo "A string '$findme' foi encontrada na string '$mystring'";
    echo " e existe na posição $pos";
}*/

?> 